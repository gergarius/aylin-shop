#from flask import Flask
#app = Flask(__name__)

#@app.route('/')
#def hello_world():
#   return 'Hello, Docker!'

def person_info(name='noname', age=10):
    print(name)
    print(age)

person_info('Arsen', 39)
person_info()