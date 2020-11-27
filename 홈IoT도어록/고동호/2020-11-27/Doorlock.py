'''''''''''''''''''''
### 라이브러리 호출 ###
'''''''''''''''''''''
import RPi_I2C_driver as I2C
import RPi.GPIO as GPIO
from multiprocessing import Process
from tkinter import *
from time import *
import pymysql

'''''''''''''''''''''
### 글로벌 변수 선언 ###
'''''''''''''''''''''

### LCD ###
lcd = I2C.lcd(0x27)
last_time = time()

### GPIO Setting###
GPIO.setmode(GPIO.BCM)
GPIO.setup(13, GPIO.IN)
GPIO.setup(18, GPIO.OUT)

##### Data Base #####
db = pymysql.connect(host="192.168.0.185", port=3306, user="root", passwd="0000", db="project", charset='utf8')
cursor = db.cursor()

check_input = 0

global passwd_input = ""

sql = "SELECT * FROM doorlock"
cursor.execute(sql)
result = cursor.fetchall()
passwd_data = result[0][6]

'''''''''''''''''''''
###### 함수 선언 ######
'''''''''''''''''''''
# 잠금장치 열림
def Door_Open():
    p = GPIO.PWM(18, 50)
    p.start(0)
    p.ChangeDutyCycle(2.5)
    sleep(0.7)
    p.stop()

# 잠금장치 잠김
def Door_Close():
    p = GPIO.PWM(18, 50)
    p.start(0)
    p.ChangeDutyCycle(12.5)
    sleep(0.7)
    p.stop()

# LCD 날짜 시간 표기 함수
def Door_time():
    ymd = "   %04d/%02d/%02d" %(now.tm_year, now.tm_mon, now.tm_mday)
    hms = "    %02d:%02d:%02d" %(now.tm_hour, now.tm_min, now.tm_sec)
    lcd.lcd_display_string(ymd, 1)
    lcd.lcd_display_string(hms, 2)

# Tkinter Number Event
def Press_Num(num_str):
    passwd_input += num_str

# passwd check
def Press_OK():
    if passwd_input == passwd_data:
        Door_Open()
        print("Door Open")
        passwd_input = ""
    else:
        print("Password is incorrect")
        passwd_input = ""
    
#### Tkinter User Interface####
def Show_Dialog():
    root = Tk()
    root.title("Home IoT DoorLock")
    root.geometry("403x585")
    root.resizable(False, False)
    
    img1 = PhotoImage(file="icons/one.png")
    img2 = PhotoImage(file="icons/two.png")
    img3 = PhotoImage(file="icons/three.png")
    img4 = PhotoImage(file="icons/four.png")
    img5 = PhotoImage(file="icons/five.png")
    img6 = PhotoImage(file="icons/six.png")
    img7 = PhotoImage(file="icons/seven.png")
    img8 = PhotoImage(file="icons/eight.png")
    img9 = PhotoImage(file="icons/nine.png")
    img0 = PhotoImage(file="icons/zero.png")
    imgOk = PhotoImage(file="icons/ok.png")
    imgHt = PhotoImage(file="icons/hashtag.png")
    
    btn1 = Button(root, image = img1, width = 128, height = 128, command = lambda:Press_Num("1"))
    btn1.grid(row=0,column=0)
    btn2 = Button(root, image = img2, width = 128, height = 128, command = lambda:Press_Num("2"))
    btn2.grid(row=0,column=1)
    btn3 = Button(root, image = img3, width = 128, height = 128, command = lambda:Press_Num("3"))
    btn3.grid(row=0,column=2)
    btn4 = Button(root, image = img4, width = 128, height = 128, command = lambda:Press_Num("4"))
    btn4.grid(row=1,column=0)
    btn5 = Button(root, image = img5, width = 128, height = 128, command = lambda:Press_Num("5"))
    btn5.grid(row=1,column=1)
    btn6 = Button(root, image = img6, width = 128, height = 128, command = lambda:Press_Num("6"))
    btn6.grid(row=1,column=2)
    btn7 = Button(root, image = img7, width = 128, height = 128, command = lambda:Press_Num("7"))
    btn7.grid(row=2,column=0)
    btn8 = Button(root, image = img8, width = 128, height = 128, command = lambda:Press_Num("8"))
    btn8.grid(row=2,column=1)
    btn9 = Button(root, image = img9, width = 128, height = 128, command = lambda:Press_Num("9"))
    btn9.grid(row=2,column=2)
    btnOk = Button(root, image = imgOk, width = 128, height = 128, command = Press_OK)
    btnOk.grid(row=3,column=0)
    btn0 = Button(root, image = img0, width = 128, height = 128, command = lambda:Press_Num("0"))
    btn0.grid(row = 3,column = 1)
    btnHt = Button(root, image=imgHt, width = 128, height = 128)
    btnHt.grid(row = 3,column = 2)
    btnOpen = Button(root, text = 'Open', width = 10, height = 2, command = Door_Open)
    btnOpen.grid(row = 4,column = 1)
    btnClose = Button(root, text = 'Close', width = 10, height = 2, command = Door_Close)
    btnClose.grid(row = 4,column = 2)
    mainloop()

# Multiprocessing
Process(target = Show_Dialog).start()

# LCD 시간 표기 및 DB 데이터 동기화
while(True):
    try:       
        now = localtime()
        Door_time()
        #############################
        cursor.execute(sql)
        result = cursor.fetchall()
        input_data = result[0][4]
        db.commit()
        #############################
        input_value = GPIO.input(13)
        
        if check_input == 0:
            if input_value == True:
                print("Door Open")
                Door_Open()
                check_input = 1
                
        elif check_input == 1:
            if input_value == True:
                print("Door Close")
                Door_Close()
                check_input = 0
          
        ################### SQL CONNECT CHECK####################
        if input_data == 1:
            Door_Open()
            reset_sql = "UPDATE doorlock SET input = 0 WHERE dStatus = 'off'"
            cursor.execute(reset_sql)
            db.commit()
         
    except KeyboardInterrupt:
        lcd.clear()
        db.close()
        GPIO.cleanup()
        p.stop()
        break