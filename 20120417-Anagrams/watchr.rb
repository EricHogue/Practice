watch ('.*\.php$') {|phpFile| run_php_unit(phpFile)} 

$lastRunSuccessful = false

def run_php_unit(modified_file)
	system('clear')
	if (system("phpunit -c phpunit.xml")) 
		if (!$lastRunSuccessful)
			system("notify-send 'Tests are back to green'")
		end

		$lastRunSuccessful = true
	else
		$lastRunSuccessful = false
		system("notify-send 'Test failed'")
	end
end

run_php_unit('')
