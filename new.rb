require('csv')
file1 = File.open("awards.csv","r")
file2 = File.open("contracts.csv","r")

awards = []
CSV.foreach(file1) {|row| 
	awards << row
}

contracts = []
CSV.foreach(file2){ |row|
	contracts << row
}

x = 0
line = []
while x < contracts.length
	if x == 0
		awards[0].delete_at(0)
		line[x] = contracts[0] + awards[0]
	else
		contractsMerge = 0
		y = 0
		while y < awards.length
			if (awards[y][0] == contracts[x][0])
				awardsIndex =  awards[y][0]

				awards[y].delete_at(0)
				line[x] = contracts[x]+ awards[y]

				total = 0
				if ((line[x][0] == awardsIndex) && (line[x][1] == 'Current'))
					#puts line[x][12].inspect
					#total += line[x][12].to_i
					Integer(line[x][12]).times { |a| 
						total+=a 
					}
					puts total
				end
				contractsMerge = 1
			end
			y += 1
		end
		if contractsMerge == 0
			line[x]=contracts[x];
		end
	end
	x += 1
end

File.open("final.csv", "w"){|f| 
 	f.write(line.inject([]) { |csv, row| csv << CSV.generate_line(row) }.join(""))
 }

print "Total Amount of current contracts: ", total,"\n"

file1.close
file2.close