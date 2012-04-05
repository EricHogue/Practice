
watch ('.*\.php') {|phpFile| run_php_unit(phpFile[0])}

def run_php_unit(modified_file)
	system('clear')
	system("phpunit -c phpunit.xml")
end
