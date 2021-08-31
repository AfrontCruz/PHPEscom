
class Controller:
    def __init__(self, classname, attributes):
        self.classname = classname[1]
        self.attributes = attributes

    def getFormat(self):
        model = "<?php\n\nrequire('./Controller.php');\nrequire('./InterfaceController.php');\nrequire('../model/" + self.classname.lower() +  ".php');\n\nclass " + self.classname + "Controller extends Controller implements InterfaceController{\n"
        model += "\tprivate $" + self.classname.lower() + ";\n"
        model += "\n\tpublic function __construct(){\n\t\tparent::__construct(\"" + self.classname.lower() + "\");\n\t\t$this->" + self.classname.lower() + " = new " + self.classname + "( $this->data->" + self.classname.lower() + " );\n\t}"
        model += "\n\tpublic function exec(){\n"
        model += "\t\t$function = $this->method;\n"
        model += "\t\t$this->$function();\n\t}"
        model += "\n\tpublic function POST(){\n"
        model += "\t\tif( $this->params == null)\n"
        model += "\t\t\tprint_r( json_encode( $this->" + self.classname.lower() + "->create() ) );\n" 
        model += "\t\telse{\n\t\t\t$function = $this->params[0];\n\t\t\t$this->$function();\n\t\t}\n\t}" 
        model += "\n\tpublic function GET(){\n"
        model += "\t\tif( $this->params == null)\n"
        model += "\t\t\tprint_r( json_encode( $this->" + self.classname.lower() + "->read() ) );\n" 
        model += "\t\telse{\n\t\t\t$function = $this->params[0];\n\t\t\t$this->$function();\n\t\t}\n\t}" 
        model += "\n\tpublic function PUT(){\n"
        model += "\t\tprint_r( json_encode( $this->" + self.classname.lower() + "->update($this->data) ) );\n\t}" 
        model += "\n\tpublic function DELETE(){\n"
        model += "\t\tprint_r( json_encode( $this->" + self.classname.lower() + "->delete($this->data) ) );\n\t}" 
        model += "\n\tpublic function OPTIONS(){ }\n"
        model += "\n\tpublic function find(){\n"
        model += "\t\tprint_r( json_encode( $this->" + self.classname.lower() + "->find( "
        i = 1
        for f in self.attributes:
            if( int(f[5]) ):
                model += "$this->params[" + str(i) + "],"
                i = i + 1
        model = model[:-1]
        model += " ) ) );\n\t}"
        model += "\n\tpublic function test(){\n\t\techo \"Test " + self.classname + "\";\n\t}"
        model += "\n}"
        model += "\n\n$" + self.classname.lower() + "Controller = new " + self.classname + "Controller();\n$" + self.classname.lower() + "Controller->exec();" 
        file_model = open( "./api/control/" + self.classname.lower() + ".php", "w" )
        n = file_model.write( model )
        file_model.close()