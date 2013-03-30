import csv
import json

f = open( '/Users/hlep/Documents/_Schoolio/_GRAD/_Fall 2012/SI 649/FinalProject/Data/Swimming.csv', 'r' )
reader = csv.DictReader( f, fieldnames = ( "Country Name", "1896 Gold","1896 Silver","1896 Bronze","1896 Total","1900 Gold","1900 Silver","1900 Bronze","1900 Total","1904 Gold","1904 Silver","1904 Bronze","1908 Total","1908 Gold","1908 Silver","1908 Bronze","1908 Total","1912 Gold","1912 Silver","1912 Bronze","1912 Total","1920 Gold","1920 Silver","1920 Bronze","1920 Total","1924 Gold","1924 Silver","1924 Bronze","1924 Total","1928 Gold","1928 Silver","1928 Bronze","1928 Total","1932 Gold","1932 Silver","1932 Bronze","1932 Total","1936 Gold","1936 Silver","1936 Bronze","1936 Total","1948 Gold","1948 Silver","1948 Bronze","1948 Total","1952 Gold","1952 Silver","1952 Bronze","1952 Total","1956 Gold","1956 Silver","1956 Bronze","1956 Total","1960 Gold","1960 Silver","1960 Bronze","1960 Total","1964 Gold","1964 Silver","1964 Bronze","1964 Total","1968 Gold","1968 Silver","1968 Bronze","1968 Total","1972 Gold","1972 Silver","1972 Bronze","1972 Total","1976 Gold","1976 Silver","1976 Bronze","1976 Total","1980 Gold","1980 Silver","1980 Bronze","1980 Total","1984 Gold","1984 Silver","1984 Bronze","1984 Total","1988 Gold","1988 Silver","1988 Bronze","1988 Total","1992 Gold","1992 Silver","1992 Bronze","1992 Total","1996 Gold","1996 Silver","1996 Bronze","1996 Total","2000 Gold","2000 Silver","2000 Bronze","2000 Total","2004 Gold","2004 Silver","2004 Bronze","2004 Total","2008 Gold","2008 Silver","2008 Bronze","2008 Total",) )
print(reader.next()['Country Name'])
output = json.dumps( dict((row.pop('Country Name'), row) for row in reader ), indent = 2)
text_file = open('/Users/hlep/Documents/_Schoolio/_GRAD/_Fall 2012/SI 649/FinalProject/Data/Swimming3.json', "w")
text_file.write(output)
text_file.close()
