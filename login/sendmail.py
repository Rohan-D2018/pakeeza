
# Python code to illustrate Sending mail with attachments
# from your Gmail account 
 
# libraries to be imported
import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from email.mime.base import MIMEBase
from email import encoders
import os,sys
import datetime

#senders mail id and password
fromaddr = "tcode20@gmail.com"
password ="testcode@20"

#recievers mail id
# toaddr = "nalawadeakash724@gmail.com"

toaddr = str(sys.argv[1])


access_token = str(sys.argv[3])
redirect_link = str(sys.argv[2])

#current time and date
nowmail = datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')


def send_mail(fromaddr,toaddr,password,now,access_token,redirect_link):
    # instance of MIMEMultipart
    msg = MIMEMultipart()
    
    # storing the senders email address  
    msg['From'] = fromaddr
     
    # storing the receivers email address 
    msg['To'] = toaddr
     
    # storing the subject 
    msg['Subject'] = "Pakeeza!! Reset your Password"
     
    # string to store the body of the mail
    body = "You can reset your password by using the access token: " + access_token + " on the given link " + redirect_link
    # body+= "Upper Limit = "+upper_limit+"\n"
    # body+="Lower Limit =  "+lower_limit
     
    # attach the body with the msg instance
    msg.attach(MIMEText(body, 'plain'))
    
    # # instance of MIMEBase and named as p
    # p = MIMEBase('application', 'octet-stream')
     
    # encoders.encode_base64(p)
      
    # creates SMTP session
    s = smtplib.SMTP('smtp.gmail.com:587')
     
    # start TLS for security
    s.starttls()
     
    # Authentication
    s.login(fromaddr, password)
     
    # Converts the Multipart msg into a string
    text = msg.as_string()
     
    # sending the mail
    s.sendmail(fromaddr, toaddr, text)
     
    # terminating the session
    s.quit()

send_mail(fromaddr,toaddr,password,nowmail,access_token,redirect_link)