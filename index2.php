<?

    // require common code
    require_once("common.php"); 
    header("Content-type: application/json");

    $home_team = mysql_real_escape_string($_GET["home"]);
    $away_team = mysql_real_escape_string($_GET["away"]);    
    
    $home_result = mysql_query("SELECT * FROM results WHERE HomeTeam = '$home_team' AND AwayTeam = '$away_team'");
    $away_result = mysql_query("SELECT * FROM results WHERE HomeTeam = '$away_team' AND AwayTeam = '$home_team'");
    $current_result = mysql_query("SELECT * FROM current WHERE HomeTeam = '$away_team' AND AwayTeam = '$home_team'");
    
    while($row3 = mysql_fetch_assoc($current_result))
    {
        $result_curr['Season'] = $row3['Season'];
        $result_curr['HFix_HGoals'] = '?';
        $result_curr['HFix_AGoals'] = '?';
        $result_curr['AFix_HGoals'] = $row3['FTAG'];
        $result_curr['AFix_AGoals'] = $row3['FTHG'];
        if($row3['FTR'] == 'H')
        {
           $result_curr['AwayFixture'] = 'A';
        }
        else if($row3['FTR'] == 'A')
        {
            $result_curr['AwayFixture'] = 'H';
        }
        else
        {
            $result_curr['AwayFixture'] = 'D';
        }
         
    $results[] = $result_curr;
    }
    
    while($row = mysql_fetch_assoc($home_result))
    {
        $result['HFix_HGoals'] = $row['FTHG'];
        $result['HFix_AGoals'] = $row['FTAG'];
     
        if($row['FTR'] == 'H')
        {
            $result['Season'] = $row['Season'];
            $result['HomeFixture'] = 'H';
            $row2 = mysql_fetch_assoc($away_result);
            $result['AFix_HGoals'] = $row2['FTAG'];
            $result['AFix_AGoals'] = $row2['FTHG'];

            if($row2['FTR'] == 'H')
            {
               $result['AwayFixture'] = 'A';
            }
            else if($row2['FTR'] == 'A')
            {
                $result['AwayFixture'] = 'H';
            }
            else
            {
                $result['AwayFixture'] = 'D';
            }
        }
        else if($row['FTR'] == 'A')
        {
            $result['Season'] = $row['Season'];
            $result['HomeFixture'] = 'A';
            $row2 = mysql_fetch_assoc($away_result);
            $result['AFix_HGoals'] = $row2['FTAG'];
            $result['AFix_AGoals'] = $row2['FTHG'];
            
            if($row2['FTR'] == 'H')
            {
               $result['AwayFixture'] = 'A';
            }
            else if($row2['FTR'] == 'A')
            {
                $result['AwayFixture'] = 'H';
            }
            else
            {
                $result['AwayFixture'] = 'D';
            }
        }
        else if($row['FTR'] == 'D')
        {
            $result['Season'] = $row['Season'];
            $result['HomeFixture'] = 'D';
            $row2 = mysql_fetch_assoc($away_result);
            $result['AFix_HGoals'] = $row2['FTAG'];
            $result['AFix_AGoals'] = $row2['FTHG'];
            
            if($row2['FTR'] == 'H')
            {
               $result['AwayFixture'] = 'A';
            }
            else if($row2['FTR'] == 'A')
            {
                $result['AwayFixture'] = 'H';
            }
            else
            {
                $result['AwayFixture'] = 'D';
            }
        }
        
        $results[] = $result;
    }
    
          
    print(json_encode($results));
    
    
?>


