# GD-API
<hr>
1. GDConfig <br>
2. GDProfile <br>
3. GDSong<br>
4. GDLevel<br>
5. GDComment<br>
6. GDMessage<br>
7. GDError (For Exception)

## Example code<hr>
```php
<?php
include "/gd-api/autoload.php";
$app = new GDLevel ("http://boomlings.com/database", 60078339);
echo $app->getPassword();
?>
```
## codes functions<hr>
### GDConfig
1. ```new GDConfig($host, $username = null, $password = null);```</br>
2. ```getUserID ();```</br>
3. ```getGJP();```</br>
4. ```getAccountID();```</br>
5. ```getAccInfo ($type, $icon = "icon");```</br>
6. ```downloadSaveData (__DIR__."/1");```</br>
7. ```uploadSaveData (__DIR__."/1");```</br>

### GDLevel

1. ```new GDLevel ("host", ID-LEVEL);```</br>
2. ```downloadLevel (__DIR__."/1");```</br>
3. ```getLevelName ();```</br>
4. ```getDescription ();```</br>
5. ```getObject ();```</br>
6. ```getPassword ();```</br>
7. ```getUserID ();```</br>
8. ```getPopularity ();``` In array </br>
9. ```getInfo ();``` In array </br>
10. ```getFullString ();``` </br>

### GDProfile

1. ```new GDProfile ("host", "accountID", false);```</br>
2. ```getIcon ("ship");```</br>
3. ```getUsername ();```</br>
4. ```getStars ();```</br>
5. ```getDiamonds ();```</br>
6. ```getDemon ();```</br>
7. ```getCP ();```</br>
8. ```getGoldCoins ();```</br>
9. ```getCoins ();```</br>
10. ```getUserID ();```</br>
11. ```getYouTube ();```</br>
12. ```getTwitter ();```</br>
13. ```getTwitch ();```</br>

### GDSong

1. ```new GDSong ("host", SONG-ID);```</br>
2. ```getDownloadLink ();```</br>
3. ```getTitle ();```</br>
4. ```getCreator ();```</br>
5. ```getSize ();```</br>
6. ```downloadSong ();```</br>

### GDComment

1. ```new GDComment ("host", "username", "password");```</br>
2. ```postAccComment ("Hi");```</br>
3. ```postComment ("Hi", LEVEL-ID);```</br>
4. ```fetchComment (LEVEL-ID, mode, page);```</br>
5. ```fetchAccComment ();```</br>
6. ```setAccountID (AccID);``` to set AccID</br>
7. ```setPage (PageNum);```</br>
8. ```setUserID (UserID);``` to set UserID </b>
9. ```fetchCommentHistory (1);```</br>
10. ```getPage ();```</br>

### GDMessage

1. ```new GDMessage ("host", "username", "password");```</br>
2. ```getMessage (pagenum);```</br>
3. ```readMessage (messageID);```</br>
4. ```deleteMessage (messageID);```</br>
5. ```sendMessage ("Subject", "Body", toAccID);```</br>

<hr>
For Example code goto <a href="https://github.com/FamryAmri/GD-API/tree/master/test">Here </a>
<br>
Composer isnt available now...
