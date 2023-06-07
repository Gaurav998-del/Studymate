from fuzzywuzzy import fuzz, process
import mysql.connector
mydb = mysql.connector.connect(host='localhost',user='root',passwd='',database='knowledgehub2')
mycursor = mydb.cursor()
mycursor.execute("select permalink from questions")
result = mycursor.fetchall()
for rec in result:
    r2=fuzz.WRatio('how is starvation?',rec)

    if r2 >= 85:
        sql = "insert into qt (title) VALUES (%s)"
        val = rec
        mycursor.execute(sql,val)
    else:
        print("nothing")
mydb.commit()
