<?

    // require common code
    require_once("common.php"); 
    header("Content-type: application/json");

    $home_team = mysql_real_escape_string($_GET["home"]);
    $away_team = mysql_real_escape_string($_GET["away"]);    
    
    $counter = 0;
    $home_wins = 0;
    $away_wins = 0;
    $draws = 0;
        
    $home_result = mysql_query("SELECT * FROM results WHERE HomeTeam = '$home_team'AND AwayTeam = '$away_team'");
    $away_result = mysql_query("SELECT * FROM results WHERE HomeTeam = '$away_team'AND AwayTeam = '$home_team'");

    $quote = array();
        
    while ($row = mysql_fetch_array($home_result))
    {   
        $counter++;
        if ($row["FTR"] == 'H')
        {    
            $home_wins++;
        }
        else if ($row["FTR"] == "A")
        {    
            $away_wins++;
        }
        else
        {
            $draws++;
        }
        
        $quote["HomeTeam"] = $row['HomeTeam'];
        $quote["AwayTeam"] = $row['AwayTeam'];
    }
        
    while ($row = mysql_fetch_array($away_result))
    {
        $counter++;
        if ($row["FTR"] == 'A')
        {    
            $home_wins++;
        }
        else if ($row["FTR"] == "H")
        {    
            $away_wins++;
        }
        else
        {
            $draws++;
        }
    }


    {
        
        $quote["Home"] = $home_wins;
        $quote["Away"] = $away_wins;
        $quote["Draw"] = $draws;
    }

    print(json_encode($quote));

?>

