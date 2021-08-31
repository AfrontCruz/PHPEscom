
class Body:
    def __init__(self, classname, attributes):
        self.classname = classname[1]
        self.attributes = attributes

    def getFormat(self):
        file_json = open( "./json/" + self.classname + ".json", "w" )
        json = "{\n\t\"" + self.classname.lower() + "\":{"
        for f in self.attributes:
            if( int(f[2]) ):
                json += "\n\t\t\"" + f[1] + "\":\"\","
        json = json[:-1]
        json += "\n\t}\n}"
        n = file_json.write( json )
        file_json.close()