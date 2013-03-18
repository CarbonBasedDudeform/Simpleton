<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="Style/Style.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
        
        <title>Simpleton</title>
    </head>
    <body>
        <div id="AddSub"><form action="AddSub.php" method="post"> <input name="sub" type="text" placeholder="subscription url..." class="subscriptionBox"><input type="submit" class="subscriptionSubmit"></form></div>
        <div id="subscriptions" class="subscriptionList">
            <?php
            
                $username = "Dom";
                $password = "Password";
                $db = "simpletondb";

                $conn = new mysqli("127.0.0.1", $username, $password, $db);
                
                $query = "SELECT * FROM subscription";
                $result = $conn->query($query);
                
                while ($ans = $result->fetch_assoc())
                {
                    $feedUrl = $ans['URL'];
                    $rawFeed = file_get_contents($feedUrl);
                    $xml = new SimpleXMLElement($rawFeed);
                    $title = $xml->channel->title;
                    
                    if (empty($title))
                    {
                        $title = $feedUrl;
                    }
                    
                    echo "<div class='subscriptionItem'><input type=hidden value=" . $feedUrl . ">" . $title . "</div>";
                }
           ?>
        </div>
        <div id="mainArea" class="mainArea">
            <?php
                if (empty($_GET))
                {
                    echo "Select a feed on the left.";
                } else {
                    $feedUrl = $_GET['url'];
                    $rawFeed = file_get_contents($feedUrl);
                    $xml = new SimpleXMLElement($rawFeed);

                    foreach($xml->channel->item as $item)
                    {
                        echo "<div class='feedItem'><input type=hidden value='" . $item->link . "'>" . $item->title . "</a></div>";
                    }
                }
            ?>
        </div>
        
        <div id="logout"><input type="button" text="Log Out" value="Log Out" class="logoutBtn"></div>
    </body>
    
    <script>
        $(".feedItem").hover(function () {
            $(this).css("color", "#FFF");
        }, function () {
            $(this).css("color", "#000");
        });
        
        $(".feedItem").click((function () {
            window.open( $(this).children("input[type='hidden']").val());
        }));
        
        $(".subscriptionItem").click(function () {
            window.location = "Index.php?url=" + $(this).children("input[type='hidden']").val();
        });
    </script>
</html>
