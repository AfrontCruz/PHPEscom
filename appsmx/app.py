import csv
import model
import controller
import body

classes = []

name = input("Ingrese el nombre del CSV: ")

with open('./classes/' + name + '.csv') as File:  
    reader = csv.reader(File)
    for row in reader:
        classes.append(row)

classname = classes.pop(0)
classes.pop(0)
mod = model.Model(classname, classes)
con = controller.Controller(classname, classes)
body = body.Body(classname, classes)
mod.getFormat()
con.getFormat()
body.getFormat()