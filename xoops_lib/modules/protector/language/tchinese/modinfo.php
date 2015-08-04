<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'protector' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","Xoops Protector 防護模組");

// A brief description of this module
define($constpref."_DESC","此模組可保護您的XOOPS網站免於遭受各種攻擊，例如Dos阻斷攻擊、隱碼攻擊及各種污染");

// Menu
define($constpref."_ADMININDEX","防護中心");
define($constpref."_ADVISORY","安全建議");
define($constpref."_PREFIXMANAGER","前綴字串管理員");
define($constpref.'_ADMENU_MYBLOCKSADMIN','權限') ;

// Configs
define($constpref.'_GLOBAL_DISBL','暫時關閉');
define($constpref.'_GLOBAL_DISBLDSC','所有的防護暫時關閉。<br />在測試後，別忘了將此選項調回來。');

define($constpref.'_DEFAULT_LANG','預設語系');
define($constpref.'_DEFAULT_LANGDSC','指定語系在執行 common.php 之前');

define($constpref.'_RELIABLE_IPS','可信賴的IP');
define($constpref.'_RELIABLE_IPSDSC','可用「|」符號隔開IP。「^」表示相同的IP開頭，「$」表示相同的IP結尾。');

define($constpref.'_LOG_LEVEL','紀錄等級');
define($constpref.'_LOG_LEVELDSC','');

define($constpref.'_BANIP_TIME0','擋掉此 IP 的時間（秒）');

define($constpref.'_LOGLEVEL0','無');
define($constpref.'_LOGLEVEL15','簡潔');
define($constpref.'_LOGLEVEL63','一般');
define($constpref.'_LOGLEVEL255','完整');

define($constpref.'_HIJACK_TOPBIT','Session 劫持對策');
define($constpref.'_HIJACK_TOPBITDSC','防止 Session 劫持：預設為32 bit（亦即單一固定IP）。<br />假如您的IP是不固定的，請利用bits數值來設定IP範圍。<br />例如：假使您的 IP 可以移至 192.168.0.0 到 192.168.0.255 的範圍中，請設為 24(bit)');
define($constpref.'_HIJACK_DENYGP','登入後不允許 IP 有變動的群組');
define($constpref.'_HIJACK_DENYGPDSC','防止 Session 劫持：請選擇不允許 IP 有變動的群組。<b>（建議把管理員群組「1」打開）</b>');
define($constpref.'_SAN_NULLBYTE','空位元組（null-bytes）處理');
define($constpref.'_SAN_NULLBYTEDSC','結尾字元 "\\0" 時常被惡意攻擊所使用，一個空位元組（null-byte） 將會被變更為空白。<b>（強烈建議設為「是」）</b>');
define($constpref.'_DIE_NULLBYTE','假如找到空位元組（null-byte）就強制踢出');
define($constpref.'_DIE_NULLBYTEDSC','結尾字元 "\\0" 時常被惡意攻擊所使用，一個空位元組（null-byte） 將會被變更為空白。<b>（強烈建議設為「是」）</b>');
define($constpref.'_DIE_BADEXT','假如有惡意檔案被上傳就強制踢出');
define($constpref.'_DIE_BADEXTDSC','假如有人企圖上傳一些可以執行的惡意檔案，例如副檔名為.php的檔案，此模組將強制踢出XOOPS。<br />假如您時常會上傳 PHP 的附檔到 B-Wiki 或 PukiWikiMod，那麼請將此選項設為「否」。');
define($constpref.'_CONTAMI_ACTION','發現變數污染時網站該進行什麼動作？');
define($constpref.'_CONTAMI_ACTIONDS','當有些人企圖污染XOOPS系統的全域變數時，請選擇網站要採取什麼動作？<b>（建議選擇「空白畫面」）</b>');
define($constpref.'_ISOCOM_ACTION','發現不成對的註解語法時，網站該進行什麼動作？');
define($constpref.'_ISOCOM_ACTIONDSC','防止資料庫隱碼攻擊：當「/*」被發現時，請選擇網站要採取什麼動作。<br />「進行補強」意味在結尾處增加另一個「*/」。<b>（建議選擇「進行補強」）</b>');
define($constpref.'_UNION_ACTION','發現UNION語法時，網站該進行什麼動作？');
define($constpref.'_UNION_ACTIONDSC','防止資料庫隱碼攻擊：當一些語法如SQL的「UNION」被發現時，請選擇網站要採取什麼動作。<br />「進行補強」意味將「union」改為「uni-on」。<b>（建議選擇「進行補強」）');
define($constpref.'_ID_INTVAL','強制將數字類的變數（像是流水號）值設為整數');
define($constpref.'_ID_INTVALDSC','所有變數名稱為「*id」的其值都將被強制設為整數。這個選項可以保護您避免受到 XSS（跨網站攻擊程式）以及 SQL Injections（隱碼攻擊）。雖然是建議您將此像設為「是」，但此舉也有可能造成部份模組運作不正常（如果該模組的傳遞的參數確實是要文字的話）。');
define($constpref.'_FILE_DOTDOT','避免被目錄穿越（Directroy Traversals）');
define($constpref.'_FILE_DOTDOTDSC','它會將所有的看起像是要進行目錄穿越（Directroy Traversals）的請求指令中，排除掉「..」，以避免被目錄穿越。');

define($constpref.'_BF_COUNT','防止暴力攻擊法');
define($constpref.'_BF_COUNTDSC','設定您允許匿名者在十秒內試圖登入的次數，假如某些人登入失敗次數高於此數字，那麼他的IP將會自動被擋掉。');

define($constpref.'_BWLIMIT_COUNT','頻寬限制');
define($constpref.'_BWLIMIT_COUNTDSC','指定在監控期間對於 mainfile.php 最大的存取量。一般來說，在主機CPU效能足夠的話，此值應為 0。此數值若小於10則直接忽略之。');

define($constpref.'_DOS_SKIPMODS','避免被誤判為阻斷攻擊及網路爬蟲的模組');
define($constpref.'_DOS_SKIPMODSDSC','若有那種常常會重新整理畫面的模組，請輸入該模組的資料夾名名稱，以避免被誤為是阻斷攻擊或網路爬蟲，可用「|」分開。');

define($constpref.'_DOS_EXPIRE','高負載攻擊的監控時間（秒）');
define($constpref.'_DOS_EXPIREDSC','針對高頻率的重新整理（F5攻擊）以極高負載的網路爬蟲，設定欲監控時間的值。');

define($constpref.'_DOS_F5COUNT','F5攻擊的判斷標準（次）');
define($constpref.'_DOS_F5COUNTDSC','為防止阻斷攻擊，指定容許重新整理的合理次數，以判斷是否要當作惡意攻擊。');
define($constpref.'_DOS_F5ACTION','對付F5攻擊的因應作為');

define($constpref.'_DOS_CRCOUNT','網路爬蟲的判斷標準（次）');
define($constpref.'_DOS_CRCOUNTDSC','預防高負載的網路爬蟲，指定容許存取合理次數，以判斷是否要當作惡意的網路爬蟲。');
define($constpref.'_DOS_CRACTION','對付高負載網路爬蟲的因應作為');

define($constpref.'_DOS_CRSAFE','允許讀取本站的網路爬蟲');
define($constpref.'_DOS_CRSAFEDSC','利用正規表達式（perl regex pattern）來允許讀取本站的網路爬蟲：假如符合設定條件，那麼此網路爬蟲將不會被視為惡意的網路爬蟲。例如：<b>/(bingbot|Googlebot|Yahoo! Slurp)/i</b>');

define($constpref.'_OPT_NONE','無（僅紀錄）');
define($constpref.'_OPT_SAN','進行補強');
define($constpref.'_OPT_EXIT','空白畫面');
define($constpref.'_OPT_BIP','永久擋掉此IP');
define($constpref.'_OPT_BIPTIME0','暫時擋掉此IP');

define($constpref.'_DOSOPT_NONE','無（僅紀錄）');
define($constpref.'_DOSOPT_SLEEP','睡眠狀態');
define($constpref.'_DOSOPT_EXIT','空白畫面');
define($constpref.'_DOSOPT_BIP','永久擋掉此IP');
define($constpref.'_DOSOPT_BIPTIME0','暫時擋掉此IP');
define($constpref.'_DOSOPT_HTA','根據 .htaccess 來擋掉（實驗性置）');

define($constpref.'_BIP_EXCEPT','IP永遠不會被列入黑名單的群組');
define($constpref.'_BIP_EXCEPTDSC','指定IP永遠不會被列入黑名單的群組。<b>（建議把管理員群組「1」打開）</b>');

define($constpref.'_DISABLES','關閉 XOOPS 中較危險的功能');

define($constpref.'_DBLAYERTRAP','開啟資料庫層級的防隱碼攻擊');
define($constpref.'_DBLAYERTRAPDSC','此功能幾乎可以完全防堵隱碼攻擊。此功能需要來自於 databasefactory的支援，您可以在安全性建議頁面查核之。此設定必須開啟，請勿關閉。');
define($constpref.'_DBTRAPWOSRV','針對隱碼攻擊不檢查 _SERVER 變數');
define($constpref.'_DBTRAPWOSRVDSC','部份主機有開啟資料庫層級的防隱碼攻擊。這會導致偵測錯誤並視為引碼攻擊。假如您有得到這樣的錯誤，請將此項目打開。您應該知道此項目會減弱資料庫層級的防隱碼攻擊的能力。');

define($constpref.'_BIGUMBRELLA','啟用 XSS 跨網站攻擊防護傘');
define($constpref.'_BIGUMBRELLADSC','這可以讓您免於受到大部分的 XSS 跨網站弱點攻擊，但並非 100%');

define($constpref.'_SPAMURI4U','防堵垃圾文：已註冊使用者發佈的網址量');
define($constpref.'_SPAMURI4UDSC','假如：除了管理員以外的已註冊使用者在文章中發佈的網址數量大於指定值，那麼該文章會被視為垃圾文章。0 意味著關閉此功能。');
define($constpref.'_SPAMURI4G','防堵垃圾文：匿名使用者發佈的網址量');
define($constpref.'_SPAMURI4GDSC','假如匿名使用者在文章中發佈的網址數量大於指定值，那麼該文章會被視為垃圾文章。0 意味著關閉此功能。');

//3.40b
define($constpref."_ADMINHOME","首頁");
define($constpref."_ADMINABOUT","關於");
//3.50
define($constpref.'_STOPFORUMSPAM_ACTION','停止垃圾留言');
define($constpref.'_STOPFORUMSPAM_ACTIONDSC','從 www.stopforumspam.com資料庫比對發布者的資料以阻擋垃圾發布者。這需要 php CURL 函式庫。');


}