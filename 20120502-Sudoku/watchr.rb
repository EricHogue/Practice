watch ('.*\.php$') {|phpFile| 
	run_all
} 

watch ('.*\.feature$') {|phpFile| 
	clear_screen
	run_behat
} 

$lastRunSuccessful = false

def run_php_unit()
	if (system("phpunit -c phpunit.xml")) 
		if (!$lastRunSuccessful)
			#system("notify-send 'Tests are back to green'")
		end

		$lastRunSuccessful = true
		
		true
	else
		$lastRunSuccessful = false
		#system("notify-send 'Test failed'")

		false
	end
end

def run_behat
	puts 'BEHAT'
	system("behat")
end

def clear_screen
	system('clear')
end

def run_all
	clear_screen
	if run_php_unit
		puts "\n\n"
		run_behat
	end
end

run_all
