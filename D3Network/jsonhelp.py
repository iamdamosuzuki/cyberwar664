import csv
import json

data = ([
	{
		"article": "33",
		"author": "Myers, Steven Lee",
		"expert": "52",
		"id": "52",
		"name": "Pszczel, Robert"
	},
	{
		"article": "33",
		"author": "Myers, Steven Lee",
		"expert": "51",
		"id": "51",
		"name": "Mikko, Madis"
	},
	{
		"article": "32",
		"author": "O'Hanlon, Michael",
		"expert": "29",
		"id": "29",
		"name": "Berkowitz, Bruce"
	},
	{
		"article": "32",
		"author": "O'Hanlon, Michael",
		"expert": "30",
		"id": "30",
		"name": "Toffler, Alvin"
	},
	{
		"article": "31",
		"author": "Schwartz, John",
		"expert": "25",
		"id": "25",
		"name": "DeLong, B. K"
	},
	{
		"article": "31",
		"author": "Schwartz, John",
		"expert": "27",
		"id": "27",
		"name": "Etzioni, Amitai"
	},
	{
		"article": "31",
		"author": "Schwartz, John",
		"expert": "28",
		"id": "28",
		"name": "Farber, David"
	},
	{
		"article": "31",
		"author": "Schwartz, John",
		"expert": "26",
		"id": "26",
		"name": "O'Hanlon, Michael"
	},
	{
		"article": "31",
		"author": "Schwartz, John",
		"expert": "5",
		"id": "5",
		"name": "Spafford, Eugene"
	},
	{
		"article": "30",
		"author": "Markoff, John",
		"expert": "23",
		"id": "23",
		"name": "Levy, Elias"
	},
	{
		"article": "28",
		"author": "Markoff, John",
		"expert": "22",
		"id": "22",
		"name": "Rasch, Mark"
	},
	{
		"article": "28",
		"author": "Markoff, John",
		"expert": "21",
		"id": "21",
		"name": "Lukasik, Steven"
	},
	{
		"article": "28",
		"author": "Markoff, John",
		"expert": "20",
		"id": "20",
		"name": "Knecht, Ronald"
	},
	{
		"article": "28",
		"author": "Markoff, John",
		"expert": "3",
		"id": "3",
		"name": "Shelton, Henry"
	},
	{
		"article": "27",
		"author": "Becker, Elizabeth",
		"expert": "17",
		"id": "17",
		"name": "Hamre, John J."
	},
	{
		"article": "27",
		"author": "Becker, Elizabeth",
		"expert": "16",
		"id": "16",
		"name": "Arkin, William"
	},
	{
		"article": "26",
		"author": "Weiner, Tim",
		"expert": "18",
		"id": "18",
		"name": "Lake, Anthony"
	},
	{
		"article": "26",
		"author": "Weiner, Tim",
		"expert": "6",
		"id": "6",
		"name": "Clarke, Richard A."
	},
	{
		"article": "25",
		"author": "Lohr, Steve",
		"expert": "14",
		"id": "14",
		"name": "Schwartau, Winn"
	},
	{
		"article": "25",
		"author": "Lohr, Steve",
		"expert": "15",
		"id": "15",
		"name": "Neumann, Peter"
	},
	{
		"article": "25",
		"author": "Lohr, Steve",
		"expert": "11",
		"id": "11",
		"name": "Libicki, Martin"
	},
	{
		"article": "25",
		"author": "Lohr, Steve",
		"expert": "13",
		"id": "13",
		"name": "Horton, Barry"
	},
	{
		"article": "25",
		"author": "Lohr, Steve",
		"expert": "10",
		"id": "10",
		"name": "Frank, Howard"
	},
	{
		"article": "25",
		"author": "Lohr, Steve",
		"expert": "12",
		"id": "12",
		"name": "Deutch, John M."
	},
	{
		"article": "48",
		"author": "Schwirtz, Michael",
		"expert": "61",
		"id": "61",
		"name": "Holbrooke, Richard C."
	},
	{
		"article": "42",
		"author": "Weiner, Tim",
		"expert": "6",
		"id": "6",
		"name": "Clarke, Richard A."
	},
	{
		"article": "42",
		"author": "Weiner, Tim",
		"expert": "65",
		"id": "65",
		"name": "Card, Andrew H. Jr."
	},
	{
		"article": "42",
		"author": "Weiner, Tim",
		"expert": "7",
		"id": "7",
		"name": "Ridge, Tom"
	},
	{
		"article": "50",
		"author": "Sanger, David E.",
		"expert": "50",
		"id": "50",
		"name": "Blair, Dennis"
	},
	{
		"article": "50",
		"author": "Sanger, David E.",
		"expert": "49",
		"id": "49",
		"name": "Hathaway, Melissa"
	},
	{
		"article": "50",
		"author": "Sanger, David E.",
		"expert": "48",
		"id": "48",
		"name": "McConnell, Mike"
	},
	{
		"article": "48",
		"author": "Chivers, C.J. ",
		"expert": "61",
		"id": "61",
		"name": "Holbrooke, Richard C."
	},
	{
		"article": "34",
		"author": "Weiner, Tim",
		"expert": "12",
		"id": "12",
		"name": "Deutch, John M."
	},
	{
		"article": "35",
		"author": "Markoff, John",
		"expert": "55",
		"id": "55",
		"name": "Woodcock, Bill"
	},
	{
		"article": "35",
		"author": "Markoff, John",
		"expert": "56",
		"id": "56",
		"name": "Viik, Linnar"
	},
	{
		"article": "35",
		"author": "Markoff, John",
		"expert": "47",
		"id": "47",
		"name": "Nazario, Jose"
	},
	{
		"article": "35",
		"author": "Markoff, John",
		"expert": "57",
		"id": "57",
		"name": "Evron, Gadi"
	},
	{
		"article": "35",
		"author": "Markoff, John",
		"expert": "54",
		"id": "54",
		"name": "Aaviksoo, Jaak"
	},
	{
		"article": "35",
		"author": "Markoff, John",
		"expert": "53",
		"id": "53",
		"name": "Aarelaid, Hillar"
	},
	{
		"article": "35",
		"author": "Landler, Mark",
		"expert": "55",
		"id": "55",
		"name": "Woodcock, Bill"
	},
	{
		"article": "35",
		"author": "Landler, Mark",
		"expert": "56",
		"id": "56",
		"name": "Viik, Linnar"
	},
	{
		"article": "35",
		"author": "Landler, Mark",
		"expert": "47",
		"id": "47",
		"name": "Nazario, Jose"
	},
	{
		"article": "35",
		"author": "Landler, Mark",
		"expert": "57",
		"id": "57",
		"name": "Evron, Gadi"
	},
	{
		"article": "35",
		"author": "Landler, Mark",
		"expert": "54",
		"id": "54",
		"name": "Aaviksoo, Jaak"
	},
	{
		"article": "35",
		"author": "Landler, Mark",
		"expert": "53",
		"id": "53",
		"name": "Aarelaid, Hillar"
	},
	{
		"article": "36",
		"author": "Markoff, John",
		"expert": "58",
		"id": "58",
		"name": "Smith, Richard"
	},
	{
		"article": "36",
		"author": "Markoff, John",
		"expert": "2",
		"id": "2",
		"name": "Bennett, Rob"
	},
	{
		"article": "37",
		"author": "Becker, Elizabeth",
		"expert": "62",
		"id": "62",
		"name": "Gehman, Harold Jr."
	},
	{
		"article": "37",
		"author": "Becker, Elizabeth",
		"expert": "3",
		"id": "3",
		"name": "Shelton, Henry"
	},
	{
		"article": "37",
		"author": "Becker, Elizabeth",
		"expert": "63",
		"id": "63",
		"name": "Cohen, William S."
	},
	{
		"article": "39",
		"author": "Myers, Steven Lee",
		"expert": "59",
		"id": "59",
		"name": "Scales, Robert H. Jr. "
	},
	{
		"article": "39",
		"author": "Myers, Steven Lee",
		"expert": "64",
		"id": "64",
		"name": "Moskos, Charles"
	},
	{
		"article": "40",
		"author": "Schwartz, John",
		"expert": "5",
		"id": "5",
		"name": "Spafford, Eugene"
	},
	{
		"article": "42",
		"author": "Becker, Elizabeth",
		"expert": "6",
		"id": "6",
		"name": "Clarke, Richard A."
	},
	{
		"article": "42",
		"author": "Becker, Elizabeth",
		"expert": "65",
		"id": "65",
		"name": "Card, Andrew H. Jr."
	},
	{
		"article": "42",
		"author": "Becker, Elizabeth",
		"expert": "7",
		"id": "7",
		"name": "Ridge, Tom"
	},
	{
		"article": "43",
		"author": "Schmitt, Eric",
		"expert": "60",
		"id": "60",
		"name": "Eberhart, Ralph E. "
	},
	{
		"article": "44",
		"author": "Lichtblau, Eric",
		"expert": "8",
		"id": "8",
		"name": "Andrews, Robert E."
	},
	{
		"article": "44",
		"author": "Lichtblau, Eric",
		"expert": "39",
		"id": "39",
		"name": "Vatis, Michael"
	},
	{
		"article": "45",
		"author": "Schwartz, John",
		"expert": "36",
		"id": "36",
		"name": "Dunham, Ken "
	},
	{
		"article": "45",
		"author": "Schwartz, John",
		"expert": "31",
		"id": "31",
		"name": "Gordon, Sarah"
	},
	{
		"article": "45",
		"author": "Schwartz, John",
		"expert": "37",
		"id": "37",
		"name": "Miller, Harris N."
	},
	{
		"article": "45",
		"author": "Schwartz, John",
		"expert": "33",
		"id": "33",
		"name": "Pack, Seth"
	},
	{
		"article": "45",
		"author": "Schwartz, John",
		"expert": "39",
		"id": "39",
		"name": "Vatis, Michael"
	},
	{
		"article": "45",
		"author": "Schwartz, John",
		"expert": "34",
		"id": "34",
		"name": "Weafer, Vincent"
	},
	{
		"article": "45",
		"author": "Schwartz, John",
		"expert": "38",
		"id": "38",
		"name": "Wraight, Chris"
	},
	{
		"article": "46",
		"author": "Markoff, John",
		"expert": "41",
		"id": "41",
		"name": "Liscouski, Bob"
	},
	{
		"article": "46",
		"author": "Markoff, John",
		"expert": "44",
		"id": "44",
		"name": "Conner, William F."
	},
	{
		"article": "46",
		"author": "Markoff, John",
		"expert": "45",
		"id": "45",
		"name": "Charney, Scott"
	},
	{
		"article": "46",
		"author": "Markoff, John",
		"expert": "43",
		"id": "43",
		"name": "Yoran, Amit"
	},
	{
		"article": "47",
		"author": "Zeller, Tom Jr. ",
		"expert": "46",
		"id": "46",
		"name": "Sergeant, Matt"
	},
	{
		"article": "48",
		"author": "Barnard, Anne",
		"expert": "61",
		"id": "61",
		"name": "Holbrooke, Richard C."
	},
	{
		"article": "49",
		"author": "Markoff, John",
		"expert": "47",
		"id": "47",
		"name": "Nazario, Jose"
	},
	{
		"article": "50",
		"author": "Markoff, John",
		"expert": "50",
		"id": "50",
		"name": "Blair, Dennis"
	},
	{
		"article": "50",
		"author": "Markoff, John",
		"expert": "49",
		"id": "49",
		"name": "Hathaway, Melissa"
	},
	{
		"article": "50",
		"author": "Markoff, John",
		"expert": "48",
		"id": "48",
		"name": "McConnell, Mike"
	},
	{
		"article": "50",
		"author": "Shankar, Thom",
		"expert": "50",
		"id": "50",
		"name": "Blair, Dennis"
	},
	{
		"article": "50",
		"author": "Shankar, Thom",
		"expert": "49",
		"id": "49",
		"name": "Hathaway, Melissa"
	},
	{
		"article": "50",
		"author": "Shankar, Thom",
		"expert": "48",
		"id": "48",
		"name": "McConnell, Mike"
	},
	{
		"article": "52",
		"author": "Shankar, Thom",
		"expert": "68",
		"id": "68",
		"name": "Berrigan, Frida"
	},
	{
		"article": "52",
		"author": "Shankar, Thom",
		"expert": "67",
		"id": "67",
		"name": "Leed, Maren"
	},
	{
		"article": "52",
		"author": "Sanger, David E.",
		"expert": "68",
		"id": "68",
		"name": "Berrigan, Frida"
	},
	{
		"article": "52",
		"author": "Sanger, David E.",
		"expert": "67",
		"id": "67",
		"name": "Leed, Maren"
	},
	{
		"article": "54",
		"author": "Markoff, John",
		"expert": "72",
		"id": "72",
		"name": "Stewart, Joe"
	},
	{
		"article": "54",
		"author": "Markoff, John",
		"expert": "71",
		"id": "71",
		"name": "Secureworks"
	},
	{
		"article": "54",
		"author": "Markoff, John",
		"expert": "47",
		"id": "47",
		"name": "Nazario, Jose"
	},
	{
		"article": "54",
		"author": "Markoff, John",
		"expert": "69",
		"id": "69",
		"name": "Arbor Networks"
	},
	{
		"article": "54",
		"author": "Hun-Sang, Choe",
		"expert": "72",
		"id": "72",
		"name": "Stewart, Joe"
	},
	{
		"article": "54",
		"author": "Hun-Sang, Choe",
		"expert": "71",
		"id": "71",
		"name": "Secureworks"
	},
	{
		"article": "54",
		"author": "Hun-Sang, Choe",
		"expert": "47",
		"id": "47",
		"name": "Nazario, Jose"
	},
	{
		"article": "54",
		"author": "Hun-Sang, Choe",
		"expert": "69",
		"id": "69",
		"name": "Arbor Networks"
	},
	{
		"article": "55",
		"author": "Markoff, John",
		"expert": "74",
		"id": "74",
		"name": "Minnich, Ron"
	},
	{
		"article": "55",
		"author": "Markoff, John",
		"expert": "75",
		"id": "75",
		"name": "Rudish, Don"
	},
	{
		"article": "55",
		"author": "Markoff, John",
		"expert": "73",
		"id": "73",
		"name": "Vanderveen, Keith "
	},
	{
		"article": "56",
		"author": "Markoff, John",
		"expert": "77",
		"id": "77",
		"name": "Peterson, Patrick "
	},
	{
		"article": "56",
		"author": "Markoff, John",
		"expert": "76",
		"id": "76",
		"name": "Joffe, Rodney"
	},
	{
		"article": "57",
		"author": "Shankar, Thom",
		"expert": "78",
		"id": "78",
		"name": "Dickson, John B."
	},
	{
		"article": "57",
		"author": "Shankar, Thom",
		"expert": "79",
		"id": "79",
		"name": "Pirko, Matt"
	},
	{
		"article": "57",
		"author": "Shankar, Thom",
		"expert": "80",
		"id": "80",
		"name": "Sandhu, Ravi "
	},
	{
		"article": "57",
		"author": "Shankar, Thom",
		"expert": "81",
		"id": "81",
		"name": "Williams, Dwayne"
	},
	{
		"article": "58",
		"author": "Kristof, Nicholas D. ",
		"expert": "82",
		"id": "82",
		"name": "Kamm, John"
	},
	{
		"article": "59",
		"author": "Markoff, John",
		"expert": "85",
		"id": "85",
		"name": "Chilton, Gen. Kevin P. "
	},
	{
		"article": "59",
		"author": "Sanger, David E.",
		"expert": "85",
		"id": "85",
		"name": "Chilton, Gen. Kevin P. "
	},
	{
		"article": "59",
		"author": "Shankar, Thom",
		"expert": "85",
		"id": "85",
		"name": "Chilton, Gen. Kevin P. "
	},
	{
		"article": "60",
		"author": "Markoff, John",
		"expert": "89",
		"id": "89",
		"name": "Willinger, Walter"
	},
	{
		"article": "60",
		"author": "Markoff, John",
		"expert": "87",
		"id": "87",
		"name": "Webster, Doug"
	},
	{
		"article": "60",
		"author": "Markoff, John",
		"expert": "88",
		"id": "88",
		"name": "Kleinberg, Jon. M."
	},
	{
		"article": "60",
		"author": "Markoff, John",
		"expert": "91",
		"id": "91",
		"name": "Doyle, John C."
	},
	{
		"article": "60",
		"author": "Markoff, John",
		"expert": "90",
		"id": "90",
		"name": "Alderson, David"
	},
	{
		"article": "61",
		"author": "Fathi, Nazila ",
		"expert": "92",
		"id": "92",
		"name": "Khoini, Ali Akbar Moussavi"
	},
	{
		"article": "65",
		"author": "Sanger, David E.",
		"expert": "95",
		"id": "95",
		"name": "Melman, Yossi"
	},
	{
		"article": "65",
		"author": "Sanger, David E.",
		"expert": "94",
		"id": "94",
		"name": "Langner, Ralph"
	},
	{
		"article": "65",
		"author": "Sanger, David E.",
		"expert": "93",
		"id": "93",
		"name": "Heinonen, Olli"
	},
	{
		"article": "65",
		"author": "Sanger, David E.",
		"expert": "96",
		"id": "96",
		"name": "Blitzblau, Shai "
	},
	{
		"article": "65",
		"author": "Markoff, John",
		"expert": "95",
		"id": "95",
		"name": "Melman, Yossi"
	},
	{
		"article": "65",
		"author": "Markoff, John",
		"expert": "94",
		"id": "94",
		"name": "Langner, Ralph"
	},
	{
		"article": "65",
		"author": "Markoff, John",
		"expert": "93",
		"id": "93",
		"name": "Heinonen, Olli"
	},
	{
		"article": "65",
		"author": "Markoff, John",
		"expert": "96",
		"id": "96",
		"name": "Blitzblau, Shai "
	},
	{
		"article": "66",
		"author": "Markoff, John",
		"expert": "97",
		"id": "97",
		"name": "Reed, Thomas C."
	},
	{
		"article": "66",
		"author": "Markoff, John",
		"expert": "94",
		"id": "94",
		"name": "Langner, Ralph"
	},
	{
		"article": "69",
		"author": "Shankar, Thom",
		"expert": "98",
		"id": "98",
		"name": "Bacevich, Andrew J. "
	},
	{
		"article": "72",
		"author": "Burns, John F. ",
		"expert": "47",
		"id": "47",
		"name": "Nazario, Jose"
	},
	{
		"article": "72",
		"author": "Somaiya, Ravi",
		"expert": "47",
		"id": "47",
		"name": "Nazario, Jose"
	},
	{
		"article": "73",
		"author": "Bumiller, Elisabeth",
		"expert": "99",
		"id": "99",
		"name": "Jing, Huang"
	},
	{
		"article": "75",
		"author": "Shankar, Thom",
		"expert": "100",
		"id": "100",
		"name": "Scowcroft, Brent"
	},
	{
		"article": "75",
		"author": "Sanger, David E.",
		"expert": "100",
		"id": "100",
		"name": "Scowcroft, Brent"
	},
	{
		"article": "77",
		"author": "Somaiya, Ravi",
		"expert": "101",
		"id": "101",
		"name": "Coleman, Gabriella"
	},
	{
		"article": "77",
		"author": "Richmond, Riva",
		"expert": "101",
		"id": "101",
		"name": "Coleman, Gabriella"
	},
	{
		"article": "80",
		"author": "Barboza, David",
		"expert": "102",
		"id": "102",
		"name": "Moss, Jeff"
	},
	{
		"article": "80",
		"author": "Drew, Kevin",
		"expert": "102",
		"id": "102",
		"name": "Moss, Jeff"
	},
	{
		"article": "82",
		"author": "Shankar, Thom",
		"expert": "103",
		"id": "103",
		"name": "Lewis, James Andrew"
	},
	{
		"article": "82",
		"author": "Schmitt, Eric",
		"expert": "103",
		"id": "103",
		"name": "Lewis, James Andrew"
	},
	{
		"article": "83",
		"author": "Landler, Mark",
		"expert": "106",
		"id": "106",
		"name": "Ebinger, Charles K. "
	},
	{
		"article": "86",
		"author": "Shankar, Thom",
		"expert": "108",
		"id": "108",
		"name": "Freier, Nathan"
	},
	{
		"article": "86",
		"author": "Shankar, Thom",
		"expert": "107",
		"id": "107",
		"name": "Singh, Michael "
	},
	{
		"article": "87",
		"author": "Kershner, Isabel",
		"expert": "110",
		"id": "110",
		"name": "Weissman, Avi"
	},
	{
		"article": "87",
		"author": "Kershner, Isabel",
		"expert": "109",
		"id": "109",
		"name": "Yisrael, Yitzhak Ben"
	},
	{
		"article": "88",
		"author": "Perlroth, Nicole",
		"expert": "111",
		"id": "111",
		"name": "Irvine, Jerry "
	},
	{
		"article": "91",
		"author": "Joseph, Channing",
		"expert": "115",
		"id": "115",
		"name": "Sidran, Edra"
	},
	{
		"article": "91",
		"author": "Joseph, Channing",
		"expert": "114",
		"id": "114",
		"name": "Kounios, John"
	},
	{
		"article": "91",
		"author": "Joseph, Channing",
		"expert": "112",
		"id": "112",
		"name": "Estabrooke, Ivy "
	},
	{
		"article": "91",
		"author": "Joseph, Channing",
		"expert": "113",
		"id": "113",
		"name": "Cohn, Cmdr. Joseph"
	},
	{
		"article": "94",
		"author": "Perlroth, Nicole",
		"expert": "116",
		"id": "116",
		"name": "Gostev, Alexander"
	},
	{
		"article": "95",
		"author": "Erdbrink, Thomas",
		"expert": "116",
		"id": "116",
		"name": "Gostev, Alexander"
	},
	{
		"article": "97",
		"author": "Myers, Steven Lee",
		"expert": "117",
		"id": "117",
		"name": "Wise, David"
	},
	{
		"article": "97",
		"author": "Shane, Scott",
		"expert": "117",
		"id": "117",
		"name": "Wise, David"
	},
	{
		"article": "97",
		"author": "Wong, Edward",
		"expert": "117",
		"id": "117",
		"name": "Wise, David"
	},
	{
		"article": "98",
		"author": "Schwartz, John",
		"expert": "122",
		"id": "122",
		"name": "MacPherson, Andrew"
	},
	{
		"article": "98",
		"author": "Schwartz, John",
		"expert": "118",
		"id": "118",
		"name": "Elder, Robert"
	},
	{
		"article": "98",
		"author": "Schwartz, John",
		"expert": "120",
		"id": "120",
		"name": "Kurtz, Paul"
	},
	{
		"article": "98",
		"author": "Schwartz, John",
		"expert": "103",
		"id": "103",
		"name": "Lewis, James Andrew"
	},
	{
		"article": "98",
		"author": "Schwartz, John",
		"expert": "119",
		"id": "119",
		"name": "McPherson, Danny"
	},
	{
		"article": "98",
		"author": "Schwartz, John",
		"expert": "121",
		"id": "121",
		"name": "Stapleton-Gray, Ross"
	},
	{
		"article": "99",
		"author": "Shankar, Thom",
		"expert": "125",
		"id": "125",
		"name": "Beckstrom, Rod"
	},
	{
		"article": "99",
		"author": "Shankar, Thom",
		"expert": "103",
		"id": "103",
		"name": "Lewis, James Andrew"
	},
	{
		"article": "99",
		"author": "Markoff, John",
		"expert": "125",
		"id": "125",
		"name": "Beckstrom, Rod"
	},
	{
		"article": "99",
		"author": "Markoff, John",
		"expert": "103",
		"id": "103",
		"name": "Lewis, James Andrew"
	},
	{
		"article": "100",
		"author": "Perlroth, Nicole",
		"expert": "123",
		"id": "123",
		"name": "Sullivan, Sean"
	},
	{
		"article": "100",
		"author": "Perlroth, Nicole",
		"expert": "103",
		"id": "103",
		"name": "Lewis, James Andrew"
	},
	{
		"article": "100",
		"author": "Perlroth, Nicole",
		"expert": "124",
		"id": "124",
		"name": "Firstbrook, Peter "
	},
	{
		"article": "100",
		"author": "Kramer, Andrew E. ",
		"expert": "123",
		"id": "123",
		"name": "Sullivan, Sean"
	},
	{
		"article": "100",
		"author": "Kramer, Andrew E. ",
		"expert": "103",
		"id": "103",
		"name": "Lewis, James Andrew"
	},
	{
		"article": "100",
		"author": "Kramer, Andrew E. ",
		"expert": "124",
		"id": "124",
		"name": "Firstbrook, Peter "
	},
	{
		"article": "101",
		"author": "Shankar, Thom",
		"expert": "129",
		"id": "129",
		"name": "Garwin, Richard L."
	},
	{
		"article": "101",
		"author": "Shankar, Thom",
		"expert": "126",
		"id": "126",
		"name": "Owens, William A."
	},
	{
		"article": "101",
		"author": "Shankar, Thom",
		"expert": "128",
		"id": "128",
		"name": "Slocombe, Walter B."
	},
	{
		"article": "101",
		"author": "Shankar, Thom",
		"expert": "127",
		"id": "127",
		"name": "Studeman, William A,"
	},
	{
		"article": "101",
		"author": "Markoff, John",
		"expert": "129",
		"id": "129",
		"name": "Garwin, Richard L."
	},
	{
		"article": "101",
		"author": "Markoff, John",
		"expert": "126",
		"id": "126",
		"name": "Owens, William A."
	},
	{
		"article": "101",
		"author": "Markoff, John",
		"expert": "128",
		"id": "128",
		"name": "Slocombe, Walter B."
	},
	{
		"article": "101",
		"author": "Markoff, John",
		"expert": "127",
		"id": "127",
		"name": "Studeman, William A,"
	},
	{
		"article": "102",
		"author": "Ricks, Thomas E. ",
		"expert": "130",
		"id": "130",
		"name": "Sanger, David E."
	},
	{
		"article": "103",
		"author": "Markoff, John",
		"expert": "132",
		"id": "132",
		"name": "Zhou, Shiyu"
	},
	{
		"article": "103",
		"author": "Markoff, John",
		"expert": "133",
		"id": "133",
		"name": "Horowitz, Michael"
	},
	{
		"article": "104",
		"author": "Brisbane, Arthur S. ",
		"expert": "130",
		"id": "130",
		"name": "Sanger, David E."
	},
	{
		"article": "105",
		"author": "Savage, Charlie ",
		"expert": "134",
		"id": "134",
		"name": "Thornburgh, Richard "
	},
	{
		"article": "105",
		"author": "Shane, Scott",
		"expert": "134",
		"id": "134",
		"name": "Thornburgh, Richard "
	},
	{
		"article": "108",
		"author": "Keller, Bill",
		"expert": "135",
		"id": "135",
		"name": "Bickel, Alexander"
	},
	{
		"article": "111",
		"author": "Shane, Scott",
		"expert": "136",
		"id": "136",
		"name": "Healey, Jason"
	},
	{
		"article": "111",
		"author": "Shane, Scott",
		"expert": "103",
		"id": "103",
		"name": "Lewis, James Andrew"
	},
	{
		"article": "111",
		"author": "Shane, Scott",
		"expert": "137",
		"id": "137",
		"name": "Waxman, Matthew"
	},
	{
		"article": "122",
		"author": "Sanger, David E.",
		"expert": "141",
		"id": "141",
		"name": "Falkenrath, Richard "
	},
	{
		"article": "122",
		"author": "Shankar, Thom",
		"expert": "141",
		"id": "141",
		"name": "Falkenrath, Richard "
	},
	{
		"article": "124",
		"author": "Sanger, David E.",
		"expert": "142",
		"id": "142",
		"name": "Bader, Jeffrey A. "
	},
	{
		"article": "125",
		"author": "Markoff, John",
		"expert": "143",
		"id": "143",
		"name": "Bellovin, Steven M."
	},
	{
		"article": "126",
		"author": "Sanger, David E.",
		"expert": "144",
		"id": "144",
		"name": "Fitzpatrick, Mark"
	},
	{
		"article": "126",
		"author": "Broad, William J. ",
		"expert": "144",
		"id": "144",
		"name": "Fitzpatrick, Mark"
	},
	{
		"article": "127",
		"author": "Drew, Christopher",
		"expert": "146",
		"id": "146",
		"name": "Allen, Daniel D."
	},
	{
		"article": "127",
		"author": "Drew, Christopher",
		"expert": "147",
		"id": "147",
		"name": "Gillette, Terry"
	},
	{
		"article": "127",
		"author": "Drew, Christopher",
		"expert": "149",
		"id": "149",
		"name": "Harding, Joel"
	},
	{
		"article": "127",
		"author": "Drew, Christopher",
		"expert": "148",
		"id": "148",
		"name": "Kuehl, Daniel T."
	},
	{
		"article": "127",
		"author": "Markoff, John",
		"expert": "146",
		"id": "146",
		"name": "Allen, Daniel D."
	},
	{
		"article": "127",
		"author": "Markoff, John",
		"expert": "147",
		"id": "147",
		"name": "Gillette, Terry"
	},
	{
		"article": "127",
		"author": "Markoff, John",
		"expert": "149",
		"id": "149",
		"name": "Harding, Joel"
	},
	{
		"article": "127",
		"author": "Markoff, John",
		"expert": "148",
		"id": "148",
		"name": "Kuehl, Daniel T."
	},
	{
		"article": "128",
		"author": "Kramer, Andrew E. ",
		"expert": "153",
		"id": "153",
		"name": "Arquilla, John"
	},
	{
		"article": "128",
		"author": "Kramer, Andrew E. ",
		"expert": "150",
		"id": "150",
		"name": "Lin, Herbert"
	},
	{
		"article": "128",
		"author": "Kramer, Andrew E. ",
		"expert": "152",
		"id": "152",
		"name": "Sokolov, Vladimir V."
	},
	{
		"article": "128",
		"author": "Kramer, Andrew E. ",
		"expert": "151",
		"id": "151",
		"name": "Wells II, Linton"
	},
	{
		"article": "128",
		"author": "Markoff, John",
		"expert": "153",
		"id": "153",
		"name": "Arquilla, John"
	},
	{
		"article": "128",
		"author": "Markoff, John",
		"expert": "150",
		"id": "150",
		"name": "Lin, Herbert"
	},
	{
		"article": "128",
		"author": "Markoff, John",
		"expert": "152",
		"id": "152",
		"name": "Sokolov, Vladimir V."
	},
	{
		"article": "128",
		"author": "Markoff, John",
		"expert": "151",
		"id": "151",
		"name": "Wells II, Linton"
	}
])

parsed_data = json.loads(data)


