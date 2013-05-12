<?
    // requirements
    require_once("constants.php");

    /*
     * void
     * apologize($message)
     *
     * Apologizes to user by displaying a page with message.
     */

    function apologize($message)
    {
        // require template
        require_once("apology.php");

        // exit immediately since we're apologizing
        exit;
    }

    // connect to database server
    if (($connection = @mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD)) === false)
        apologize("Could not connect to database server.");

    // select database
    if (@mysql_select_db(DB_NAME, $connection) === false)
        apologize("Could not select database (" . DB_NAME . ").");
        
    /*
     * void
     * dump($variable)
     *
     * Facilitates debugging by dumping contents of variable
     * to browser.
     */

    function dump($variable)
    {
        // dump variable with some quick and dirty HTML
        require("dump.php");

        // exit immediately so that we can see what we printed
        exit;
    }
      

?>
