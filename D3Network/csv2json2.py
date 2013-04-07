import csv
import json

f = open( '/Applications/MAMP/htdocs/D3Network/auth_exp.csv', 'r' )
reader = csv.DictReader( f, fieldnames = ( "article","author","article","expert","id","author","id","name") )
output = json.dumps( [row for row in reader], indent = 2)
text_file = open('/Applications/MAMP/htdocs/D3Network/auth_exp.json', "w")
text_file.write(output)
text_file.close()
