
class Model:
    def __init__(self, classname, attributes):
        self.classname = classname[1]
        self.attributes = attributes

    def getFormat(self):
        model = "<?php\n\nrequire('../model/Model.php');\n\nclass " + self.classname + " extends Model implements \JsonSerializable {\n"
        for f in self.attributes:
            model += "\tprivate $" + f[1] + ";\n"
        model += "\n\tpublic function __construct($data){\n"
        for f in self.attributes:
            if( f[0] == "int" ):
                model += "\t\tif( isset( $data->" + f[1] + ") )\n\t\t\t$this->" + f[1] + " = intval($data->" + f[1] + ");\n"
            elif( f[0] == "float" ):
                model += "\t\tif( isset( $data->" + f[1] + ") )\n\t\t\t$this->" + f[1] + " = floatval($data->" + f[1] + ");\n"
            else:
                model += "\t\tif( isset( $data->" + f[1] + ") )\n\t\t\t$this->" + f[1] + " = $data->" + f[1] + ";\n"
        model += "\t}"

        model += "\n\tpublic function create(){"
        model += "\n\t\t$query = \"INSERT INTO " + self.classname + "("

        for f in self.attributes:
            if( int(f[2]) ):
                model += f[1] + ","
        model = model[:-1] + ") VALUES("

        for f in self.attributes:
            if( int(f[2]) ):
                if( f[0] == "string" ):
                    model += "'$this->" + f[1] + "',"
                else:
                    model += "$this->" + f[1] + ","
        model = model[:-1] + ")\";\n"
        model += "\t\treturn parent::createSQL( $query );"
        model += "\n\t}"
        model += "\n\tpublic function read(){"
        model += "\n\t\t$query = \"SELECT "
        for f in self.attributes:
            if( int(f[3]) ):
                model += f[1] + ","
        model = model[:-1]
        model += " FROM " + self.classname + "\";\n\t\treturn parent::readSQL($query, \"" + self.classname + "\");"
        model += "\n\t}"
        model += "\n\tpublic function update($data){"

        updatable = 0
        for f in self.attributes:
            if( int( f[4] ) ==  0):
                updatable = 1
                break
        if( updatable ):
            model += "\n\t\tif( "
            for f in self.attributes:
                if( int(f[4]) == 0 ):
                    model += "\"" + f[1] + "\" == $data->attribute || "
            model = model[:-4]
            model += ")\n\t\t\treturn false;"

        model += "\n\t\t$query = \"UPDATE " + self.classname + " SET $data->attribute = '$data->value' WHERE"
        for f in self.attributes:
            if( int(f[5]) ):
                model += " " +f[1] + " = '$data->" + f[1] + "' AND"
        model = model[:-4]
        model += ";\";"
        model += "\n\t\treturn parent::updateSQL( $query );" 
        model += "\n\t}"
        model += "\n\tpublic function delete($data){"
        model += "\n\t\t$query = \"DELETE FROM " + self.classname + " WHERE "
        for f in self.attributes:
            if( int(f[5]) ):
                model += " " +f[1] + " = '$data->" + f[1] + "' AND"
        model = model[:-4]
        model += ";\";"
        model += "\n\t\treturn parent::deleteSQL($query);"
        model += "\n\t}\n"
        model += "\tpublic function find( "
        for f in self.attributes:
            if( int(f[5]) == 1 ):
                model += "$" + f[1] + ","
        model = model[:-1] + " ){\n"
        model += "\t\t$query = \"SELECT "
        for f in self.attributes:
            if( int(f[3]) ):
                model += f[1] + ","
        model = model[:-1]
        model += " FROM " + self.classname + " WHERE"
        for f in self.attributes:
            if( int(f[5]) ):
                model += " " +f[1] + " = '$" + f[1] + "' AND"
        model = model[:-4]
        model += ";\";\n\t\treturn parent::readSQL($query, \"" + self.classname + "\");\n\t}"

        model += "\n\tpublic function rawSelect($sql){\n\t\treturn parent::readSQL($sql, \"" + self.classname + "\");\n\t}"
        model += "\n\tpublic function jsonSerialize(){\n\t\t$vars = get_object_vars($this);\n\t\treturn $vars;\n\t}"
        model += "\n}"
        file_model = open( "./api/model/" + self.classname.lower() + ".php", "w" )
        n = file_model.write( model )
        file_model.close()