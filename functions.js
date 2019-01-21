function headMouseOver(mona)
{
	var top = document.getElementById("head_top");
	var bot = document.getElementById("head_bot");
	top.className = "zeroes_hov";
	bot.className = "zeroes_hov";
	if (mona)
	{
		var i   = 0;
		for (i = 0; i < 36; i++)
		{
			var row = document.getElementById("row"+i);
			row.className = "zeroes_hov";
		}
	}

	return 0;
}

function headMouseOut(mona)
{
	var top = document.getElementById("head_top");
	var bot = document.getElementById("head_bot");
	top.className = "zeroes";
	bot.className = "zeroes";
	if (mona)
	{
		var i   = 0;
		for (i = 0; i < 36; i++)
		{
			var row = document.getElementById("row"+i);
			row.className = "zeroes";
		}
	}
	
	return 0;
}
