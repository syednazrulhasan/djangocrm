<?php
/** Adminer Editor - Compact database editor
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2009 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.8.1
*/function
adminer_errors($ac,$bc){return!!preg_match('~^(Trying to access array offset on value of type null|Undefined array key)~',$bc);}error_reporting(6135);set_error_handler('adminer_errors',E_WARNING);$sc=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($sc||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$Eg=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($Eg)$$X=$Eg;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$g;return$g;}function
adminer(){global$b;return$b;}function
version(){global$ca;return$ca;}function
idf_unescape($u){if(!preg_match('~^[`\'"]~',$u))return$u;$xd=substr($u,-1);return
str_replace($xd.$xd,$xd,substr($u,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($Qe,$sc=false){if(function_exists("get_magic_quotes_gpc")&&get_magic_quotes_gpc()){while(list($y,$X)=each($Qe)){foreach($X
as$qd=>$W){unset($Qe[$y][$qd]);if(is_array($W)){$Qe[$y][stripslashes($qd)]=$W;$Qe[]=&$Qe[$y][stripslashes($qd)];}else$Qe[$y][stripslashes($qd)]=($sc?$W:stripslashes($W));}}}}function
bracket_escape($u,$Fa=false){static$rg=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($u,($Fa?array_flip($rg):$rg));}function
min_version($Qg,$Id="",$h=null){global$g;if(!$h)$h=$g;$zf=$h->server_info;if($Id&&preg_match('~([\d.]+)-MariaDB~',$zf,$A)){$zf=$A[1];$Qg=$Id;}return(version_compare($zf,$Qg)>=0);}function
charset($g){return(min_version("5.5.3",0,$g)?"utf8mb4":"utf8");}function
script($Hf,$qg="\n"){return"<script".nonce().">$Hf</script>$qg";}function
script_src($Jg){return"<script src='".h($Jg)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($P){return
str_replace("\0","&#0;",htmlspecialchars($P,ENT_QUOTES,'utf-8'));}function
nl_br($P){return
str_replace("\n","<br>",$P);}function
checkbox($B,$Y,$Ta,$ud="",$je="",$Wa="",$vd=""){$H="<input type='checkbox' name='$B' value='".h($Y)."'".($Ta?" checked":"").($vd?" aria-labelledby='$vd'":"").">".($je?script("qsl('input').onclick = function () { $je };",""):"");return($ud!=""||$Wa?"<label".($Wa?" class='$Wa'":"").">$H".h($ud)."</label>":$H);}function
optionlist($C,$tf=null,$Mg=false){$H="";foreach($C
as$qd=>$W){$oe=array($qd=>$W);if(is_array($W)){$H.='<optgroup label="'.h($qd).'">';$oe=$W;}foreach($oe
as$y=>$X)$H.='<option'.($Mg||is_string($y)?' value="'.h($y).'"':'').(($Mg||is_string($y)?(string)$y:$X)===$tf?' selected':'').'>'.h($X);if(is_array($W))$H.='</optgroup>';}return$H;}function
html_select($B,$C,$Y="",$ie=true,$vd=""){if($ie)return"<select name='".h($B)."'".($vd?" aria-labelledby='$vd'":"").">".optionlist($C,$Y)."</select>".(is_string($ie)?script("qsl('select').onchange = function () { $ie };",""):"");$H="";foreach($C
as$y=>$X)$H.="<label><input type='radio' name='".h($B)."' value='".h($y)."'".($y==$Y?" checked":"").">".h($X)."</label>";return$H;}function
select_input($Aa,$C,$Y="",$ie="",$He=""){$Zf=($C?"select":"input");return"<$Zf$Aa".($C?"><option value=''>$He".optionlist($C,$Y,true)."</select>":" size='10' value='".h($Y)."' placeholder='$He'>").($ie?script("qsl('$Zf').onchange = $ie;",""):"");}function
confirm($Qd="",$uf="qsl('input')"){return
script("$uf.onclick = function () { return confirm('".($Qd?js_escape($Qd):'Are you sure?')."'); };","");}function
print_fieldset($t,$zd,$Tg=false){echo"<fieldset><legend>","<a href='#fieldset-$t'>$zd</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$t');",""),"</legend>","<div id='fieldset-$t'".($Tg?"":" class='hidden'").">\n";}function
bold($Ma,$Wa=""){return($Ma?" class='active $Wa'":($Wa?" class='$Wa'":""));}function
odd($H=' class="odd"'){static$s=0;if(!$H)$s=-1;return($s++%2?$H:'');}function
js_escape($P){return
addcslashes($P,"\r\n'\\/");}function
json_row($y,$X=null){static$tc=true;if($tc)echo"{";if($y!=""){echo($tc?"":",")."\n\t\"".addcslashes($y,"\r\n\t\"\\/").'": '.($X!==null?'"'.addcslashes($X,"\r\n\"\\/").'"':'null');$tc=false;}else{echo"\n}\n";$tc=true;}}function
ini_bool($hd){$X=ini_get($hd);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$H;if($H===null)$H=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$H;}function
set_password($Pg,$M,$V,$E){$_SESSION["pwds"][$Pg][$M][$V]=($_COOKIE["adminer_key"]&&is_string($E)?array(encrypt_string($E,$_COOKIE["adminer_key"])):$E);}function
get_password(){$H=get_session("pwds");if(is_array($H))$H=($_COOKIE["adminer_key"]?decrypt_string($H[0],$_COOKIE["adminer_key"]):false);return$H;}function
q($P){global$g;return$g->quote($P);}function
get_vals($F,$e=0){global$g;$H=array();$G=$g->query($F);if(is_object($G)){while($I=$G->fetch_row())$H[]=$I[$e];}return$H;}function
get_key_vals($F,$h=null,$Bf=true){global$g;if(!is_object($h))$h=$g;$H=array();$G=$h->query($F);if(is_object($G)){while($I=$G->fetch_row()){if($Bf)$H[$I[0]]=$I[1];else$H[]=$I[0];}}return$H;}function
get_rows($F,$h=null,$m="<p class='error'>"){global$g;$jb=(is_object($h)?$h:$g);$H=array();$G=$jb->query($F);if(is_object($G)){while($I=$G->fetch_assoc())$H[]=$I;}elseif(!$G&&!is_object($h)&&$m&&defined("PAGE_HEADER"))echo$m.error()."\n";return$H;}function
unique_array($I,$w){foreach($w
as$v){if(preg_match("~PRIMARY|UNIQUE~",$v["type"])){$H=array();foreach($v["columns"]as$y){if(!isset($I[$y]))continue
2;$H[$y]=$I[$y];}return$H;}}}function
escape_key($y){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$y,$A))return$A[1].idf_escape(idf_unescape($A[2])).$A[3];return
idf_escape($y);}function
where($Z,$o=array()){global$g,$x;$H=array();foreach((array)$Z["where"]as$y=>$X){$y=bracket_escape($y,1);$e=escape_key($y);$H[]=$e.($x=="sql"&&is_numeric($X)&&preg_match('~\.~',$X)?" LIKE ".q($X):($x=="mssql"?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($o[$y],q($X))));if($x=="sql"&&preg_match('~char|text~',$o[$y]["type"])&&preg_match("~[^ -@]~",$X))$H[]="$e = ".q($X)." COLLATE ".charset($g)."_bin";}foreach((array)$Z["null"]as$y)$H[]=escape_key($y)." IS NULL";return
implode(" AND ",$H);}function
where_check($X,$o=array()){parse_str($X,$Ra);remove_slashes(array(&$Ra));return
where($Ra,$o);}function
where_link($s,$e,$Y,$le="="){return"&where%5B$s%5D%5Bcol%5D=".urlencode($e)."&where%5B$s%5D%5Bop%5D=".urlencode(($Y!==null?$le:"IS NULL"))."&where%5B$s%5D%5Bval%5D=".urlencode($Y);}function
convert_fields($f,$o,$K=array()){$H="";foreach($f
as$y=>$X){if($K&&!in_array(idf_escape($y),$K))continue;$ya=convert_field($o[$y]);if($ya)$H.=", $ya AS ".idf_escape($y);}return$H;}function
cookie($B,$Y,$Bd=2592000){global$aa;return
header("Set-Cookie: $B=".urlencode($Y).($Bd?"; expires=".gmdate("D, d M Y H:i:s",time()+$Bd)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).($aa?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
restart_session(){if(!ini_bool("session.use_cookies"))session_start();}function
stop_session($yc=false){$Lg=ini_bool("session.use_cookies");if(!$Lg||$yc){session_write_close();if($Lg&&@ini_set("session.use_cookies",false)===false)session_start();}}function&get_session($y){return$_SESSION[$y][DRIVER][SERVER][$_GET["username"]];}function
set_session($y,$X){$_SESSION[$y][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($Pg,$M,$V,$k=null){global$Lb;preg_match('~([^?]*)\??(.*)~',remove_from_uri(implode("|",array_keys($Lb))."|username|".($k!==null?"db|":"").session_name()),$A);return"$A[1]?".(sid()?SID."&":"").($Pg!="server"||$M!=""?urlencode($Pg)."=".urlencode($M)."&":"")."username=".urlencode($V).($k!=""?"&db=".urlencode($k):"").($A[2]?"&$A[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
redirect($Dd,$Qd=null){if($Qd!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($Dd!==null?$Dd:$_SERVER["REQUEST_URI"]))][]=$Qd;}if($Dd!==null){if($Dd=="")$Dd=".";header("Location: $Dd");exit;}}function
query_redirect($F,$Dd,$Qd,$af=true,$fc=true,$lc=false,$gg=""){global$g,$m,$b;if($fc){$Nf=microtime(true);$lc=!$g->query($F);$gg=format_time($Nf);}$Kf="";if($F)$Kf=$b->messageQuery($F,$gg,$lc);if($lc){$m=error().$Kf.script("messagesPrint();");return
false;}if($af)redirect($Dd,$Qd.$Kf);return
true;}function
queries($F){global$g;static$Ue=array();static$Nf;if(!$Nf)$Nf=microtime(true);if($F===null)return
array(implode("\n",$Ue),format_time($Nf));$Ue[]=(preg_match('~;$~',$F)?"DELIMITER ;;\n$F;\nDELIMITER ":$F).";";return$g->query($F);}function
apply_queries($F,$S,$cc='table'){foreach($S
as$Q){if(!queries("$F ".$cc($Q)))return
false;}return
true;}function
queries_redirect($Dd,$Qd,$af){list($Ue,$gg)=queries(null);return
query_redirect($Ue,$Dd,$Qd,$af,false,!$af,$gg);}function
format_time($Nf){return
sprintf('%.3f s',max(0,microtime(true)-$Nf));}function
relative_uri(){return
str_replace(":","%3a",preg_replace('~^[^?]*/([^?]*)~','\1',$_SERVER["REQUEST_URI"]));}function
remove_from_uri($ze=""){return
substr(preg_replace("~(?<=[?&])($ze".(SID?"":"|".session_name()).")=[^&]*&~",'',relative_uri()."&"),0,-1);}function
pagination($D,$yb){return" ".($D==$yb?$D+1:'<a href="'.h(remove_from_uri("page").($D?"&page=$D".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($D+1)."</a>");}function
get_file($y,$Bb=false){$qc=$_FILES[$y];if(!$qc)return
null;foreach($qc
as$y=>$X)$qc[$y]=(array)$X;$H='';foreach($qc["error"]as$y=>$m){if($m)return$m;$B=$qc["name"][$y];$ng=$qc["tmp_name"][$y];$pb=file_get_contents($Bb&&preg_match('~\.gz$~',$B)?"compress.zlib://$ng":$ng);if($Bb){$Nf=substr($pb,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$Nf,$bf))$pb=iconv("utf-16","utf-8",$pb);elseif($Nf=="\xEF\xBB\xBF")$pb=substr($pb,3);$H.=$pb."\n\n";}else$H.=$pb;}return$H;}function
upload_error($m){$Nd=($m==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($m?'Unable to upload a file.'.($Nd?" ".sprintf('Maximum allowed file size is %sB.',$Nd):""):'File does not exist.');}function
repeat_pattern($Ee,$_d){return
str_repeat("$Ee{0,65535}",$_d/65535)."$Ee{0,".($_d%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
shorten_utf8($P,$_d=80,$Tf=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$_d).")($)?)u",$P,$A))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$_d).")($)?)",$P,$A);return
h($A[1]).$Tf.(isset($A[2])?"":"<i>‚Ä¶</i>");}function
format_number($X){return
strtr(number_format($X,0,".",','),preg_split('~~u','0123456789',-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~[^a-z0-9_]~i','-',$X);}function
hidden_fields($Qe,$Yc=array(),$Le=''){$H=false;foreach($Qe
as$y=>$X){if(!in_array($y,$Yc)){if(is_array($X))hidden_fields($X,array(),$y);else{$H=true;echo'<input type="hidden" name="'.h($Le?$Le."[$y]":$y).'" value="'.h($X).'">';}}}return$H;}function
hidden_fields_get(){echo(sid()?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
table_status1($Q,$mc=false){$H=table_status($Q,$mc);return($H?$H:array("Name"=>$Q));}function
column_foreign_keys($Q){global$b;$H=array();foreach($b->foreignKeys($Q)as$q){foreach($q["source"]as$X)$H[$X][]=$q;}return$H;}function
enum_input($T,$Aa,$n,$Y,$Wb=null){global$b;preg_match_all("~'((?:[^']|'')*)'~",$n["length"],$Kd);$H=($Wb!==null?"<label><input type='$T'$Aa value='$Wb'".((is_array($Y)?in_array($Wb,$Y):$Y===0)?" checked":"")."><i>".'empty'."</i></label>":"");foreach($Kd[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$Ta=(is_int($Y)?$Y==$s+1:(is_array($Y)?in_array($s+1,$Y):$Y===$X));$H.=" <label><input type='$T'$Aa value='".($s+1)."'".($Ta?' checked':'').'>'.h($b->editVal($X,$n)).'</label>';}return$H;}function
input($n,$Y,$r){global$U,$b,$x;$B=h(bracket_escape($n["field"]));echo"<td class='function'>";if(is_array($Y)&&!$r){$wa=array($Y);if(version_compare(PHP_VERSION,5.4)>=0)$wa[]=JSON_PRETTY_PRINT;$Y=call_user_func_array('json_encode',$wa);$r="json";}$gf=($x=="mssql"&&$n["auto_increment"]);if($gf&&!$_POST["save"])$r=null;$Gc=(isset($_GET["select"])||$gf?array("orig"=>'original'):array())+$b->editFunctions($n);$Aa=" name='fields[$B]'";if($n["type"]=="enum")echo
h($Gc[""])."<td>".$b->editInput($_GET["edit"],$n,$Aa,$Y);else{$Nc=(in_array($r,$Gc)||isset($Gc[$r]));echo(count($Gc)>1?"<select name='function[$B]'>".optionlist($Gc,$r===null||$Nc?$r:"")."</select>".on_help("getTarget(event).value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($Gc))).'<td>';$jd=$b->editInput($_GET["edit"],$n,$Aa,$Y);if($jd!="")echo$jd;elseif(preg_match('~bool~',$n["type"]))echo"<input type='hidden'$Aa value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$Aa value='1'>";elseif($n["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$n["length"],$Kd);foreach($Kd[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$Ta=(is_int($Y)?($Y>>$s)&1:in_array($X,explode(",",$Y),true));echo" <label><input type='checkbox' name='fields[$B][$s]' value='".(1<<$s)."'".($Ta?' checked':'').">".h($b->editVal($X,$n)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$n["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$B'>";elseif(($dg=preg_match('~text|lob|memo~i',$n["type"]))||preg_match("~\n~",$Y)){if($dg&&$x!="sqlite")$Aa.=" cols='50' rows='12'";else{$J=min(12,substr_count($Y,"\n")+1);$Aa.=" cols='30' rows='$J'".($J==1?" style='height: 1.2em;'":"");}echo"<textarea$Aa>".h($Y).'</textarea>';}elseif($r=="json"||preg_match('~^jsonb?$~',$n["type"]))echo"<textarea$Aa cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';else{$Pd=(!preg_match('~int~',$n["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$n["length"],$A)?((preg_match("~binary~",$n["type"])?2:1)*$A[1]+($A[3]?1:0)+($A[2]&&!$n["unsigned"]?1:0)):($U[$n["type"]]?$U[$n["type"]]+($n["unsigned"]?0:1):0));if($x=='sql'&&min_version(5.6)&&preg_match('~time~',$n["type"]))$Pd+=7;echo"<input".((!$Nc||$r==="")&&preg_match('~(?<!o)int(?!er)~',$n["type"])&&!preg_match('~\[\]~',$n["full_type"])?" type='number'":"")." value='".h($Y)."'".($Pd?" data-maxlength='$Pd'":"").(preg_match('~char|binary~',$n["type"])&&$Pd>20?" size='40'":"")."$Aa>";}echo$b->editHint($_GET["edit"],$n,$Y);$tc=0;foreach($Gc
as$y=>$X){if($y===""||!$X)break;$tc++;}if($tc)echo
script("mixin(qsl('td'), {onchange: partial(skipOriginal, $tc), oninput: function () { this.onchange(); }});");}}function
process_input($n){global$b,$l;$u=bracket_escape($n["field"]);$r=$_POST["function"][$u];$Y=$_POST["fields"][$u];if($n["type"]=="enum"){if($Y==-1)return
false;if($Y=="")return"NULL";return+$Y;}if($n["auto_increment"]&&$Y=="")return
null;if($r=="orig")return(preg_match('~^CURRENT_TIMESTAMP~i',$n["on_update"])?idf_escape($n["field"]):false);if($r=="NULL")return"NULL";if($n["type"]=="set")return
array_sum((array)$Y);if($r=="json"){$r="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$n["type"])&&ini_bool("file_uploads")){$qc=get_file("fields-$u");if(!is_string($qc))return
false;return$l->quoteBinary($qc);}return$b->processInput($n,$Y,$r);}function
fields_from_edit(){global$l;$H=array();foreach((array)$_POST["field_keys"]as$y=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$y];$_POST["fields"][$X]=$_POST["field_vals"][$y];}}foreach((array)$_POST["fields"]as$y=>$X){$B=bracket_escape($y,1);$H[$B]=array("field"=>$B,"privileges"=>array("insert"=>1,"update"=>1),"null"=>1,"auto_increment"=>($y==$l->primary),);}return$H;}function
search_tables(){global$b,$g;$_GET["where"][0]["val"]=$_POST["query"];$wf="<ul>\n";foreach(table_status('',true)as$Q=>$R){$B=$b->tableName($R);if(isset($R["Engine"])&&$B!=""&&(!$_POST["tables"]||in_array($Q,$_POST["tables"]))){$G=$g->query("SELECT".limit("1 FROM ".table($Q)," WHERE ".implode(" AND ",$b->selectSearchProcess(fields($Q),array())),1));if(!$G||$G->fetch_row()){$Oe="<a href='".h(ME."select=".urlencode($Q)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$B</a>";echo"$wf<li>".($G?$Oe:"<p class='error'>$Oe: ".error())."\n";$wf="";}}}echo($wf?"<p class='message'>".'No tables.':"</ul>")."\n";}function
dump_headers($Wc,$Ud=false){global$b;$H=$b->dumpHeaders($Wc,$Ud);$ve=$_POST["output"];if($ve!="text")header("Content-Disposition: attachment; filename=".$b->dumpFilename($Wc).".$H".($ve!="file"&&preg_match('~^[0-9a-z]+$~',$ve)?".$ve":""));session_write_close();ob_flush();flush();return$H;}function
dump_csv($I){foreach($I
as$y=>$X){if(preg_match('~["\n,;\t]|^0|\.\d*0$~',$X)||$X==="")$I[$y]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$I)."\r\n";}function
apply_sql_function($r,$e){return($r?($r=="unixepoch"?"DATETIME($e, '$r')":($r=="count distinct"?"COUNT(DISTINCT ":strtoupper("$r("))."$e)"):$e);}function
get_temp_dir(){$H=ini_get("upload_tmp_dir");if(!$H){if(function_exists('sys_get_temp_dir'))$H=sys_get_temp_dir();else{$p=@tempnam("","");if(!$p)return
false;$H=dirname($p);unlink($p);}}return$H;}function
file_open_lock($p){$Ec=@fopen($p,"r+");if(!$Ec){$Ec=@fopen($p,"w");if(!$Ec)return;chmod($p,0660);}flock($Ec,LOCK_EX);return$Ec;}function
file_write_unlock($Ec,$zb){rewind($Ec);fwrite($Ec,$zb);ftruncate($Ec,strlen($zb));flock($Ec,LOCK_UN);fclose($Ec);}function
password_file($tb){$p=get_temp_dir()."/adminer.key";$H=@file_get_contents($p);if($H||!$tb)return$H;$Ec=@fopen($p,"w");if($Ec){chmod($p,0660);$H=rand_string();fwrite($Ec,$H);fclose($Ec);}return$H;}function
rand_string(){return
md5(uniqid(mt_rand(),true));}function
select_value($X,$_,$n,$eg){global$b;if(is_array($X)){$H="";foreach($X
as$qd=>$W)$H.="<tr>".($X!=array_values($X)?"<th>".h($qd):"")."<td>".select_value($W,$_,$n,$eg);return"<table cellspacing='0'>$H</table>";}if(!$_)$_=$b->selectLink($X,$n);if($_===null){if(is_mail($X))$_="mailto:$X";if(is_url($X))$_=$X;}$H=$b->editVal($X,$n);if($H!==null){if(!is_utf8($H))$H="\0";elseif($eg!=""&&is_shortable($n))$H=shorten_utf8($H,max(0,+$eg));else$H=h($H);}return$b->selectVal($H,$_,$n,$X);}function
is_mail($Tb){$za='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$Kb='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';$Ee="$za+(\\.$za+)*@($Kb?\\.)+$Kb";return
is_string($Tb)&&preg_match("(^$Ee(,\\s*$Ee)*\$)i",$Tb);}function
is_url($P){$Kb='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return
preg_match("~^(https?)://($Kb?\\.)+$Kb(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i",$P);}function
is_shortable($n){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$n["type"]);}function
count_rows($Q,$Z,$nd,$Hc){global$x;$F=" FROM ".table($Q).($Z?" WHERE ".implode(" AND ",$Z):"");return($nd&&($x=="sql"||count($Hc)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$Hc).")$F":"SELECT COUNT(*)".($nd?" FROM (SELECT 1$F GROUP BY ".implode(", ",$Hc).") x":$F));}function
slow_query($F){global$b,$pg,$l;$k=$b->database();$hg=$b->queryTimeout();$Ef=$l->slowQuery($F,$hg);if(!$Ef&&support("kill")&&is_object($h=connect())&&($k==""||$h->select_db($k))){$td=$h->result(connection_id());echo'<script',nonce(),'>
var timeout = setTimeout(function () {
	ajax(\'',js_escape(ME),'script=kill\', function () {
	}, \'kill=',$td,'&token=',$pg,'\');
}, ',1000*$hg,');
</script>
';}else$h=null;ob_flush();flush();$H=@get_key_vals(($Ef?$Ef:$F),$h,false);if($h){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$H;}function
get_token(){$Xe=rand(1,1e6);return($Xe^$_SESSION["token"]).":$Xe";}function
verify_token(){list($pg,$Xe)=explode(":",$_POST["token"]);return($Xe^$_SESSION["token"])==$pg;}function
lzw_decompress($Ka){$Ib=256;$La=8;$Ya=array();$if=0;$jf=0;for($s=0;$s<strlen($Ka);$s++){$if=($if<<8)+ord($Ka[$s]);$jf+=8;if($jf>=$La){$jf-=$La;$Ya[]=$if>>$jf;$if&=(1<<$jf)-1;$Ib++;if($Ib>>$La)$La++;}}$Hb=range("\0","\xFF");$H="";foreach($Ya
as$s=>$Xa){$Sb=$Hb[$Xa];if(!isset($Sb))$Sb=$ch.$ch[0];$H.=$Sb;if($s)$Hb[]=$ch.$Sb[0];$ch=$Sb;}return$H;}function
on_help($eb,$Cf=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $eb, $Cf) }, onmouseout: helpMouseout});","");}function
edit_form($Q,$o,$I,$Hg){global$b,$x,$pg,$m;$Xf=$b->tableName(table_status1($Q,true));page_header(($Hg?'Edit':'Insert'),$m,array("select"=>array($Q,$Xf)),$Xf);$b->editRowPrint($Q,$o,$I,$Hg);if($I===false)echo"<p class='error'>".'No rows.'."\n";echo'<form action="" method="post" enctype="multipart/form-data" id="form">
';if(!$o)echo"<p class='error'>".'You have no privileges to update this table.'."\n";else{echo"<table cellspacing='0' class='layout'>".script("qsl('table').onkeydown = editingKeydown;");foreach($o
as$B=>$n){echo"<tr><th>".$b->fieldName($n);$Cb=$_GET["set"][bracket_escape($B)];if($Cb===null){$Cb=$n["default"];if($n["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$Cb,$bf))$Cb=$bf[1];}$Y=($I!==null?($I[$B]!=""&&$x=="sql"&&preg_match("~enum|set~",$n["type"])?(is_array($I[$B])?array_sum($I[$B]):+$I[$B]):(is_bool($I[$B])?+$I[$B]:$I[$B])):(!$Hg&&$n["auto_increment"]?"":(isset($_GET["select"])?false:$Cb)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$n);$r=($_POST["save"]?(string)$_POST["function"][$B]:($Hg&&preg_match('~^CURRENT_TIMESTAMP~i',$n["on_update"])?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(!$_POST&&!$Hg&&$Y==$n["default"]&&preg_match('~^[\w.]+\(~',$Y))$r="SQL";if(preg_match("~time~",$n["type"])&&preg_match('~^CURRENT_TIMESTAMP~i',$Y)){$Y="";$r="now";}input($n,$Y,$r);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($o){echo"<input type='submit' value='".'Save'."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Hg?'Save and continue edit':'Save and insert next')."' title='Ctrl+Shift+Enter'>\n",($Hg?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".'Saving'."‚Ä¶', this); };"):"");}}echo($Hg?"<input type='submit' name='delete' value='".'Delete'."'>".confirm()."\n":($_POST||!$o?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$pg,'">
</form>
';}if(isset($_GET["file"])){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` \0Ñ\0\n @\0¥CÑË\"\0`E„Q∏‡ˇá?¿tvM'îJd¡d\\åb0\0ƒ\"ô¿f”à§Ós5õœÁ—AùXPaJì0Ñ•ë8Ñ#RäT©ëz`à#.©«cÌX√˛»Ä?¿-\0°Im?†.´M∂Ä\0»Ø(Ãâ˝¿/(%å\0");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\n1ÃáìŸåﬁl7úáB1Ñ4vb0òÕfsëºÍn2BÃ—±Ÿòﬁn:á#(ºb.\rDc)»»a7EÑë§¬l¶√±îËi1Ãésò¥Á-4ôáf”	»Œi7Ü≥π§»t4Ö¶”yËZf4ù∞iñAT´VVêÈf:œ¶,:1¶Q›ºÒb2`«#˛>:7GÔó1—ÿ“s∞ôLóXD*bv<‹å#£e@÷:4Áß!foê∑∆t:<•‹Âíæôo‚‹\ni√≈',Èªa_§:πiÔÖ¥¡Bv¯|N˚4.5NfÅi¢vp–h∏∞l®Í°÷ö‹O¶ÅâÓ= £OFQ–ƒk\$•”iıô¿¬d2T„°p‡ 6Ñã˛á°-ÿZÄéÉ†ﬁ6Ω£Äh:¨aÃ,é£ÎÓ2ç#8–ê±#íò6n‚ÓÜÒJà¢h´tÖå±ä‰4O42ÙΩokﬁæ*r†©Ä@p@Ü!ƒæœ√Ù˛?–6¿âr[çL¡ã:2Bàjß!HbÛ√P‰=!1Vâ\"à≤0Öø\nS∆∆œD7√ÏD⁄õ√C!Ü!õ‡¶G åß »+í=tCÊ©.C§¿:+» =™™∫≤°±Â%™cÌ1MR/îE»í4Ñ©†2∞‰±†„`¬8(·”π[W‰—=âySÅb∞=÷-‹πBS+…Ø»‹˝•¯@pL4Yd„Ñqä¯„¶Í¢6£3ƒ¨Ø∏Ac‹åËŒ®åkÇ[&>ˆï®Z¡pkm]óu-c:ÿ∏àNtÊŒ¥p“ùåä8Ë=ø#ò·[.‹ﬁØç~†çÅmÀyáPP·|I÷õ˘¿ÏQ™9v[ñQïÑ\nñŸrÙ'gá+ê·T—2Ö≠V¡ız‰4ç£8˜è(	æEy*#j¨2]≠ïR“¡ë•)É¿[N≠R\$ä<>:Û≠>\$;ñ>†Ã\rªÑŒHÕ√T»\nw°N Âwÿ£¶Ï<ÔÀGw‡ˆˆπ\\YÛ_†Rt^å>é\r}åŸS\rzÈ4=µ\nLî%J„ã\",Z†8∏ûôêi˜0u©?®˚—Ù°s3#®Ÿâ†:Û¶˚ç„Ωñ»ﬁE]x›“Ås^8é£K^…˜*0—ﬁwﬁ‡»ﬁ~è„ˆ:Ì—iÿ˛èv2wΩˇ±˚^7ê„Ú7£c›—u+U%é{P‹*4ÃºÈLX./!ºâ1C≈ﬂqx!Hπ„Fd˘≠L®§®ƒ†œ`6ÎË5ÆôfÄ∏ƒÜ®=H¯l åV1ìõ\0a2◊;Å‘6Ü‡ˆ˛_Ÿáƒ\0&ÙZ‹S†d)KE'íÄnµê[X©≥\0Z…ä‘F[Pëﬁò@‡ﬂ!âÒY¬,`…\"⁄∑Å¬0Ee9yF>À‘9b∫ñåÊF5:¸àî\0}ƒ¥äá(\$û”áÎÄ37Hˆ£Ë MæA∞≤6Rï˙{Mq›7G†⁄CôCÍm2¢(åCt>[Ï-t¿/&Cõ]ÍetGÙÃ¨4@r>«¬Â<öSqï/Â˙îQÎçhmçö¿–∆Ù„ÙùL¿‹#ËÙKÀ|ÆôÑ6fKP›\r%t‘”V=\"†SH\$ù} ∏Å)w°,W\0F≥™u@ÿb¶9Ç\rr∞2√#¨DåîXÉ≥⁄yOI˘>ªÖnÅÜ«¢%„˘ê'ã›_¡Ät\rœÑzƒ\\1òhlº]Q5Mp6kÜ–ƒqh√\$£H~Õ|“›!*4åÒÚ€`SÎ˝≤S tÌPP\\g±Ë7á\n-ä:Ë¢™p¥ïîàlãBû¶Óî7”®cÉ(wO0\\:ï–wî¡ùp4àìÚ{T⁄˙jO§6H√ä∂r’•êq\n¶…%%∂y']\$ÇîaëZ”.fc’q*-ÍFW∫˙kçÑzÉ∞µjëé∞lg·å:á\$\"ﬁNº\r#…d‚√Ç¬ˇ–sc·¨Ã†ÑÉ\"j™\r¿∂ñ¶à’íºPhã1/ÇúDA)†≤›[¿kn¡p76¡Y¥âR{·M§P˚∞Ú@\n-∏a∑6˛ﬂ[ªzJH,ñdl†B£hêo≥çÏÚ¨+á#Dr^µ^µŸeöºEΩΩñ ƒúaPâÙıJG£z‡ÒtÒ†2«XŸ¢¥¡øV∂◊ﬂ‡ﬁ»≥â—B_%K=E©∏bÂºæﬂ¬ßkU(.!‹Æ8∏ú¸…I.@éKÕxn˛¨¸:√PÛ32´îmÌH		C*Ï:v‚T≈\nRπÉïµã0u¬ÌÉÊÓ“ß]ŒØòäîP/µJQd•{Lñﬁ≥:Y¡è2bºúT Òù 3”4Üó‰cÍ•V=êøÜL4Œ–rƒ!ﬂBY≥6Õ≠MeLä™‹Áúˆ˘i¿o–9< Gî§∆ï–ôMhm^ØU€N¿å∑ÚTr5HiMî/¨nÉÌù≥T†ç[-<__Ó3/Xr(<áØäÜÆ…ÙìÃu“ñGNX20Â\r\$^áç:'9Ë∂OÖÌ;◊kèºÜµf†ñN'a∂î«≠b≈,ÀV§ÙÖ´1µÔHI!%6@˙œ\$“EG⁄ú¨1ù(mU™ÂÖr’ΩÔﬂÂ`°–iN+√úÒ)öú‰0lÿ“f0√Ω[U‚¯V Ë-:I^†ò\$ÿs´b\reáëug…h™~9€ﬂàùbòµÙ¬»f‰+0¨‘ hXr›¨©!\$óe,±w+Ñ˜åÎå3ÜÃ_‚AÖkö˘\nk√rı õcuWdYˇ\\◊={.Ûƒçòê¢gªâp8út\rRZøvçJ:≤>˛£Y|+≈@¿áÉ€Cêt\rÄÅjtÅΩ6≤%¬?‡Ù«éÒí>˘/•Õ«Œ9F`◊ï‰Úv~K§ê·ˆ—R–WãzëÍlm™wL«9Yï*q¨xƒzÒËSeÆ›õ≥Ë˜£~öD‡Õ·ñ˜ùxòæÎ…üi7ï2ƒ¯—O›ªí˚_{Ò˙53‚˙têòõ_üız‘3˘d)ãCØ¬\$?K”™PÅ%œœT&˛ò&\0P◊NAé^≠~¢É†p∆ ˆœúì‘ı\r\$ﬁÔ–÷Ïb*+D6Í∂¶œàﬁÌJ\$(»olﬁÕh&îÏKBS>∏ãˆ;z∂¶x≈oz>Ìú⁄oƒZ\n ã[œvıÇÀ»úµ∞2ıOxŸêV¯0f˚Ä˙Øﬁ2Bl…bk–6ZkµhXcdÍ0*¬KT‚ØH=≠ïœÄëp0älVÈıË‚\rºå•ném¶Ô)(è ˙");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:õågCIº‹\n8ú≈3)∞À7úÖÜ81– x:\nOg#)–Ír7\n\"ÜË¥`¯|2ÃgSiñH)N¶Së‰ß\ráù\"0πƒ@‰)ü`(\$s6O!”ËúV/=ùå' T4Ê=ÑòiSòç6IO†G#“X∑VCç∆s°†Z1.–hp8,≥[¶H‰µ~Czß…Â2πlæc3öÕÈs£ëŸIÜb‚4\nÈF8T‡ÜIò›©U*fzπ‰r0ûE∆Å¿ÿyé∏ÒféY.:ÊÉIå (ÿc∑·Œã!ç_lôÌ^∑^(∂öN{Sñì)rÀq¡YìñlŸ¶3ä3⁄\nò+G•”Íy∫ÌÜÀi∂¬ÓxV3w≥uh„^rÿ¿∫¥a€î˙πçcÿË\rì®Î(.¬à∫ÅCh“<\r)Ë—£°`Ê7£ÌÚ43'm5å£»\nÅP‹:2£Pª™éãq Úˇ≈Cì}ƒ´à˙ ¡Í38ãBÿ0éhRâ»r(ú0•°b\\0åHr44å¡Bç!°p«\$érZZÀ2‹â.…É(\\é5√|\nC(Œ\"èÄPÖ¯.ç–NÃRT Œì¿Ê>ÅHNÖÅ8HP·\\¨7Jp~Ñ‹˚2%°–OC®1„.ÉßC8ŒáH»Ú*àj∞Ö·˜S(π/°Ï¨6KUú á°<2âpOIÑÙ’`ç‘‰‚≥àdOÅH†ﬁ5ç-¸∆4å„pX25-“¢Ú€à∞z7£∏\"(∞P†\\32:]U⁄ËÌ‚ﬂÖ!]∏<∑A€€§í–ﬂi⁄∞ãl\r‘\0v≤Œ#J8´œwmûÌ…§®<ä…†Ê¸%m;p#„`XùDå¯˜iZç¯N0åêï»9¯®Âç†¡Ë`ÖéwJçDøæ2“9tå¢*¯ŒyÏÀNiIh\\9∆’Ë–:ÉÄÊ·xÔ≠µyl*ö»àŒÊY†‹á¯Í8íW≥‚?µéÅﬁõ3Ÿ !\"6Âõn[¨ \r≠*\$∂∆ßænzx∆9\rÏ|*3◊£pﬁÔª∂û:(p\\;‘Àmz¢¸ß9Û–—¬å¸8NÖ¡êj2çΩ´Œ\r…HÓH&å≤(√zÑ¡7i€k£ ãä§Çc§ãeÚû˝ßtúÃÃ2:SHÛ»†√/)ñxﬁ@ÈÂtâri9•ΩıÎú8œ¿ÀÔy“∑Ω∞éVƒ+^W⁄¶≠¨kZÊYól∑ £ÅÅå4÷»∆ã™∂¿¨Ç\\E»{Ó7\0πpÜÄïDÄÑiî-TÊ˛⁄˚0l∞%=¡†–ÀÉ9(Ñ5\n\nÄn,4á\0Ëa}‹É.∞ˆRsÔÇ™\02B\\€b1üS±\0003,‘XPHJspÂdìKÉ CA!∞2*Wü‘Ò⁄2\$‰+¬f^\nÑ1åÅ¥ÚzEÉ Iv§\\‰ú2…†.*A∞ôîE(d±·∞√bÍ¬‹Ñê∆9áÇ‚Ä¡Dhê&≠™?ƒH∞sèQò2íx~n√ÅJãT2˘&„‡eRúΩôG“QéêTwÍ›ëªıPà‚„\\†)6¶Ù‚ú¬Úsh\\3®\0R	¿'\r+*;RH‡.ì!—[Õ'~≠%t< Áp‹K#¬ëÊ!ÒlﬂÃLeå≥úŸ,ƒ¿Æ&·\$	¡Ω`îñCXöâ”Ü0÷≠Âº˚≥ƒ:MÈh	Á⁄úG‰—!&3†DÅ<!Ëê23Ñ√?h§J©e ⁄h·\r°mïòNi∏£¥éíÜ NÿHl7°ÆvÇÍWIÂ.¥¡-”5÷ßeyè\rEJ\ni*º\$@⁄RU0,\$UøEÜ¶‘‘¬™u)@(tŒSJk·p!Ä~≠Ç‡d`Ã>Øï\n√;#\rp9Üj…π‹]&Nc(rÄàïTQU™ΩS∑⁄\08n`´óyïb§≈ûL‹O5ÇÓ,§Úûë>éÇÜx‚‚±f‰¥í‚ÿê+Åñ\"—IÄ{kM»[\r%∆[	§eÙa‘1! ËˇÌ≥‘Æ©F@´b)Rü£72àÓ0°\nW®ô±L≤‹ú“Ætd’+ÅÌ‹0wgl¯0n@ÚÍ…¢’iÌM´É\nAßM5nÏ\$E≥◊±N€·l©›ü◊Ï%™1 A‹˚∫˙˜›kÒrÓiFB˜œ˘ol,muNx-Õ_†÷§C( ÅêfÈl\r1p[9x(i¥B“ñ≤€zQl¸∫8C‘	¥©XU Tb£›I›`ïp+V\0Óã—;ãCbŒ¿XÒ+œíçsÔ¸]H˜“[·kãx¨G*ÙÜè]∑awn˙!≈6ÇÚ‚€–mSÌæìIﬁÕKÀ~/ù”•7ﬁ˘eeN…Úç™S´/;dÂAÜ>}l~ûœÍ ®%^¥fÁÿ¢p⁄úDEÓ√a∑Çt\nx=√k–éÑ*d∫ÍTó∫¸˚j2ü…júù\në†… ,òe=ëÜM84Ù˚‘aïj@ÓT√sè‘‰nf©›\nÓ6™\rdúº0ﬁÌÙYä'%‘ìÌﬁ~	Å“®Ü<÷ÀñAÓãñHøGÇÅ8ÒøùŒÉ\$z´{∂ª≤u2*Ü‡añ¿>ª(wåK.bPÇ{ÖÉo˝î¬¥´zµ#Î2ˆ8=…8>™§≥A,∞e∞¿Ö+ÏCËßxı*√·“-b=máôü,ãaí√lzkùÅÔ\$Wı,êmèJiÊ ß·˜Å+ãË˝0∞[Øˇ.R sK˘«‰XÁ›ZLÀÁ2ê`Ã(ÔC‡vZ°‹›¿∂Ë\$Å◊π,ÂD?H±÷NxXÙÛ)íÓéM®â\$Û,çÕ*\n—£\$<qˇ≈üh!øπSì‚É¿üxsA!ò:¥K•¡}¡≤ì˘¨£úR˛öA2k∑Xép\n<˜˛¶˝ÎlÏßŸ3Ø¯¶»ïVV¨}£g&Y›ç!Ü+Û;<∏Y«ÛüYE3r≥ŸéÒõCÌo5¶≈˘¢’≥œkk˛Ö¯∞÷€£´œt˜íU¯Ö≠)˚[˝ﬂ¡Ó}Ôÿu¥´lÁ¢:Dü¯+œè _o„‰h140÷· 0¯Øb‰Kò„¨í†ˆ˛ÈªlG™Ñ#™ö©ÍéÜ¶©Ï|UdÊ∂IK´Í¬7‡^Ï‡∏@∫ÆO\0H≈Hiä6\rá€©‹\\cg\0ˆ„Î2éBƒ*e‡ê\nÄö	Özrê!ênWz&ê {Hñ'\$X †w@“8ÎDGr*Îƒ›HÂ'p#éƒÆÄ¶‘\nd¸Ä˜,Ù•ó,¸;g~Ø\0–#ÄÃé≤Eè¬\r÷I`úÓ'É%E“.†]` –õÖÓ%&–Óm∞˝\r‚ﬁ%4SÑv#\n†ûfH\$%Î-¬#≠∆—qB‚ÌÊ†¿¬Q-Ùc2äßÇ&¬¿Ã]‡ô Ëqh\rÒl]‡Æs†–—h‰7±n#±ÇÇ⁄-‡jEØFrÁ§l&d¿ÿŸÂzÏF6∏êà¡\"†ûì|øß¢s@ﬂ±ÆÂz)0rp⁄è\0ÇX\0§ŸË|DL<!∞ÙoÑ*áD∂{.B<E™ãã0nB(Ô é|\r\nÏ^©ç‡ç h≥!Ç÷Ír\$ßí(^™~èËﬁ¬/pèq≤ÃB®≈Oöà˙,\\µ®#RRŒè%Î‰Õd–Hjƒ`¬†ÙÆÃ≠ VÂ bSídßiéEÇ¯Ôoh¥r<i/k\$-ü\$oîº+∆≈ãŒ˙l“ﬁO≥&ev∆íºi“jMPA'u'éŒí( M(h/+´ÚWDæSo∑.n∑.n∏ÏÍ(ú(\"≠¿ßhˆ&pÜ®/À/1DÃäÁjÂ®∏EËﬁ&‚¶Äè,'l\$/.,ƒd®ÖÇWÄbbO3ÛB≥sH†:J`!ì.Ä™Çá¿˚•†è,F¿—7(á»‘ø≥˚1älÂs ÷“éë≤ó≈¢q¢X\r¿öÆÉ~RÈ∞±`Æ“ûÛÆY*‰:R®˘rJ¥∑%Lœ+n∏\"à¯\r¶ŒÕáH!qbæ2‚Li±%”ﬁŒ®Wj#9”‘ObE.I:Ö6¡7\0À6+§%∞.»Öﬁ≥a7E8VSÂ?(DG®”≥BÎ%;Ú¨˘‘/<í¥˙•¿\r Ï¥>˚M¿∞@∂æÄH†Ds–∞Z[tH£Enx(å©R†xÒè˚@Ø˛GkjWî>Ã¬⁄#T/8Æc8ÈQ0ÀË_‘IIGIIí!•äYEdÀE¥^ètdÈth¬`DV!CÊ8é•\r≠¥übì3©!3‚@Ÿ33N}‚ZBÛ3	œ3‰30⁄‹M(Í>Ç }‰\\—tÍÇf†fåÀ‚I\rÆÄÛ337 X‘\"tdŒ,\nbtNO`P‚;≠‹ï“≠¿‘Ø\$\nÇûﬂ‰Z—≠5U5WUµ^ho˝‡ÊtŸPM/5K4Ej≥KQ&53GXìXx)“<5DÖè\r˚VÙ\nﬂr¢5b‹Ä\\J\">ßË1S\r[-¶ Du¿\r“‚ß√)00ÛYı»À¢∑k{\nµƒ#µﬁ\r≥^∑ã|Ëu‹ªUÂ_nÔU4…Uä~Yt”\rIö√@‰è≥ôR Û3:“uePMSË0TµwWØX»ÚÚD®Ú§KOU‹‡ïá;Uı\n†OYçÈYÕQ,M[\0˜_™DöÕ»W†æJ*Ï\rg(]‡®\r\"ZCâ©6uÍè+µYÛàY6√¥ê0™qı(ŸÛ8}êÛ3AX3T†h9j∂j‡fıMtÂPJbqMP5>è»¯∂©Yák%&\\Ç1d¢ÿE4¿ µYnê Ì\$<•U]”â1âmb÷∂ê^“ıö†Í\"NVÈﬂp∂Îpı±eM⁄ﬁ◊WÈ‹¢Ó\\‰)\n À\nf7\n◊2¥ır8ãó=Ek7tVöáµû7P¶∂L…Ìa6ÚÚv@'Ç6i‡Ôj&>±‚;≠„`“ˇa	\0p⁄®(µJ—Î)´\\ø™n˚Úƒ¨m\0º®2ÄÙeqJˆ≠PçÙtåÎ±fj¸¬\"[\0®∑Ü¢X,<\\åÓ∂◊‚˜Ê∑+mdÜÂ~‚‡öÖ—s%o∞¥mn◊),◊ÑÊ‘á≤\r4∂¬8\r±Œ∏◊mEÇH]Ç¶ò¸÷HW≠M0DÔﬂÄóÂ~èÀÅòKòÓE}¯∏¥‡|fÿ^ì‹◊\r>‘-z]2sÇxDòd[sátéS¢∂\0Qf-K`≠¢Çt‡ÿÑwTØ9ÄÊZÄ‡	¯\nB£9 Nbñ„<⁄B˛I5o◊oJÒp¿œJNdÂÀ\rçhﬁç√ê2ê\"‡xÊHC‡›çñ:ç¯˝9Yn16∆Ùzr+z±˘˛\\í˜ïúÙm ﬁ±T ˆÚ†˜@Y2lQ<2O+•%ìÕ.”Éh˘0AﬁÒ∏ä√Zãè2R¶¿1£ä/ØhH\r®XÖ»aNB&ß ƒM@÷[xåá Æ•Íñ‚8&L⁄VÕúv‡±*öj§€öGHÂ»\\ŸÆ	ô≤∂&s€\0Qö†\\\"Ëb†∞	‡ƒ\rBsõ…wùÇ	ùŸ·ûBN`ö7ßCo(Ÿ√‡®\n√®ùì®1ö9Ã*Eò ÒSÖ”Uê0U∫ tö'|îmô∞ﬁ?h[¢\$.#…5	 Â	pÑ‡yB‡@RÙ]£ÖÍ@|Ñß{ô¿ P\0xÙ/¶ w¢%§EsBdøßöCUö~O◊∑‡P‡@X‚]‘Öç®Z3®•1¶•{©eLYâ°å⁄ê¢\\í(*R`†	‡¶\nÖä‡é∫ÃQCF»*éππê‡Èú¨⁄pÜX|`N®Çæ\$Ä[Üâí@ÕU¢‡¶∂‡Z•`Zd\"\\\"ÖÇ¢£)´áIà:ËtöÏoDÊ\0[≤®‡±Ç-©ì†gÌ≥âôÆ*`hu%£,Äî¨„Iµ7ƒ´≤HÛµm§6ﬁ}Æ∫N÷Õ≥\$ªMµUYf&1˘é¿õe]pz•ß⁄I§≈m∂G/£ ∫w ‹!ï\\#5•4I•dπE¬hqÄÂ¶˜—¨kÁx|⁄k•qDöbÖz?ß∫â>˙Éæ:Üì[ËL“∆¨Z∞XöÆ:ûπÑ∑⁄ç«jﬂw5	∂YÅæ0 ©¬ì≠Ø\$\0C¢ÜdSg∏ÎÇ†{ù@î\n`û	¿√¸C ¢∑ªM∫µ‚ª≤# t}xŒNÑ˜∫á{∫€∞)Í˚CÉ FKZﬁjô¬\0PFYîB‰pFkñõ0<⁄> D<JEôög\rı.ì2ñ¸8ÈU@*Œ5fk™ÃJDÏ»…4çïTDU76…/¥ËØ@∑ÇK+Ñ√ˆJÆ∫√¬Ì@”=å‹WIOD≥85MöçN∫\$RÙ\0¯5®\r‡˘_™úÏEúÒœI´œ≥NÁl£“Ây\\Ùëà«qUÄ–Q˚†™\n@í®Ä€∫√pö¨®P€±´7‘ΩN\r˝R{*çqm›\$\0Rî◊‘ìä≈Âq–√à+U@ﬁB§ÁOf*ÜCÀ¨∫MCé‰`_ Ë¸ÚΩÀµNÍÊT‚5Ÿ¶C◊ª© ∏‡\\W√e&_Xå_ÿçhÂó¬∆Bú3¿å€%‹FW£˚Å|ôGﬁõ'≈[Ø≈Ç¿∞Ÿ’V†–#^\rÁ¶GRÄæòÄP±›FgÅ¢˚ÓØ¿Yi ˚•«z\n‚®ﬁ+ﬂ^/ì®ÄÇº•Ω\\ï6Ëﬂbºdmh◊‚@qÌç’Ah÷),J≠◊Wñ«cm˜em]é”èeœkZb0ﬂÂ˛ûÅYÒ]ymäËáfÿeπB;π”ÍO…¿wüapDW˚å…‹”{õ\0ò¿-2/bN¨s÷ΩﬁæRaìœÆh&qt\n\"’iˆRm¸hzœe¯Ü‡‹FS7µ–PPÚ‰ñ§‚‹:Bßà‚’sm∂≠Y d¸ﬁÚ7}3?*Çt˙ÚÈœlT⁄}ò~ÄÑèÄ‰=cû˝¨÷ﬁ«	û⁄3Ö;T≤Lﬁ5*	Ò~#µAïæÉëséx-7˜éf5`ÿ#\"N”b˜ØGòüãı@‹e¸[Ô¯Å§ÃsëòÄ∏-ßòM6ß£qqö hÄe5Ö\0“¢¿±˙*‡b¯IS‹…‹FŒÆ9}˝p”-¯˝`{˝±…ñkPò0T<Ñ©Z9‰0<’ö\r≠Ä;!√àg∫\r\nK‘\nïá\0¡∞*Ω\nb7(¿_∏@,Óe2\r¿]ñKÖ+\0…ˇp C\\—¢,0¨^ÓM–ßö∫©ì@ä;X\rï?\$\rájí+ˆ/¥¨BˆÊP†Ωâ˘®J{\"aÕ6ò‰âúπ|Â£\n\0ª‡\\5ìÅ–	156ˇÜ .›[¬UÿØ\0dË≤8YÁ:!—≤ë=∫¿X.≤uC™äåˆ!S∫∏áoÖp”B›¸€7∏≠≈Ø°Rh≠\\hãE=˙y:< :u≥Û2µ80ìsi¶üTsB€@\$ ÕÈ@«u	»Q∫ê¶.ÙÇT0M\\/ÍÄd+∆É\në°=‘∞då≈ÎA¢∏¢)\r@@¬h3ÄñŸ8.eZa|.‚7ùYk–c¿òÒñ'D#á®YÚ@Xçqñ=M°Ô44öB AM§ØdU\"ãHw4Ó(>Ç¨8®≤√C∏?e_`–≈X:ƒA9√∏ôÅÙp´G–‰áGy6Ω√FìXrâ°l˜1°ΩÿªêB¢√Ö9Rz©ıhBÑ{çûÄô\0ÎÂ^Ç√-‚0©%Dú5F\"\"‡⁄‹ ¬ô˙iƒ`ÀŸnAf® \"tDZ\"_‡V\$ü™!/ÖDÄ·öÜøµã¥àŸ¶°ÃÄF,25…jõTÎ·óy\0ÖNºx\rÁYl¶è#ë∆Eq\nÕ»B2ú\nÏ‡6∑Öƒ4”◊î!/¬\nÛÉâQ∏Ω*Æ;)bR∏Z0\0ƒCDoåÀûé48¿ï¥µá–eë\n„¶S%\\˙PIkêá(0¡åu/ôãG≤∆πäåº\\À}†4FpëûG˚_˜G?)g»otÅ∫[vû÷\0∞∏?b¿;™À`(ï€å‡∂NS)\n„x=Ë–+@Í‹7Éèj˙0èó,1√Özôì≠ç>0àâGc„LÖVXÙÉ±€ %¿Ö¡ÑQ+¯éÈo∆Fı»È‹∂–>Q-„cë⁄«lâ°≥§w‡Ãz5GëÍÇ@(hëc”Hı«r?àöNb˛@…®ˆ«¯∞Ólx3ãU`Ñrw™©‘U√‘Ùtÿ8‘=¿l#Úıèlˇ‰®â8•E\"åÉòôO6\nò¬1e£`\\hKfóV/–∑PaYKÁOÃ˝ Èè‡xë	âOjÑÛèr7•F;¥ÍÅBªëÍ£ÌÃíáº>Ê–¶≤V\rƒñƒ|©'Jµz´ºöî#íPB‰íY5\0NC§^\n~LrRí‘[ÃüR√¨Òg¿eZ\0xõ^ªi<Q„/)”%@ êíôfB≤Hf {%P‡\"\"Ωç¯@™˛ç)ÚíëìDE(iM2ÇSí*ÉyÚS¡\"‚Ò eÃí1å´◊ò\n4` ©>¶èQ*¶‹y∞nîíû•T‰u‘ù‚‰î—~%Å+WÅ≤XKãå£Q°[ îû‡lêPYy#DŸ¨D<´FL˙≥’@¡6']∆ãá˚\rFƒ`±!ï%\nè0êc–Ù¿À©%c8WrpGÉ.TúDoæUL2ÿ*È|\$¨:ËúròΩ@ÊÒË&“4ÅãHä> ë†ç%0*åZc(@‹]ÛÃQ:*¨ì‚(&\"xç'JO≥1π∫`>7	#Ÿ\"O4PX¸±î|B4ªÈâ[ òÈŸò\$nÔà1`ÙÍGSAı÷ÀAHª†\"Ü)‡©„S®˚fî…¶¡∫-\"ÀW˙+…ñ∫\0s-[îfoŸßÕD´êxÛÊ∏ıæ=Cö.ıì9≥≠ŒfÔ¿c¡\0¬ã7°?√ì95¥÷¶Z«0≠ÓfÏ≠®‡¯ÎH?R'q>o⁄ @aDüç˘G[;G¥DπBBdƒ°óq†ñ•2§|1πÏqô≤‰¿ŒÂ≤w<‹#™ßEYΩ^öß†≠Q\\Î[XÒÂË≈>?vÔû[ áÊäI…Õ— ÑôúÃg\0«)¥ÖÆgÖuå–g42j√∫'ÛéT‰êÑãÕvy,uí€DÜ=péH\\Éî^b‰ÏqÿÑƒit√≈XÖ¿£FP…@P˙•Täæi2#∞gÄóD·ÆôÒ%9ô@Ç");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress('');}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo'';break;case"cross.gif":echo'';break;case"up.gif":echo'';break;case"down.gif":echo'';break;case"arrow.gif":echo'';break;}}exit;}if($_GET["script"]=="version"){$Ec=file_open_lock(get_temp_dir()."/adminer.version");if($Ec)file_write_unlock($Ec,serialize(array("signature"=>$_POST["signature"],"version"=>$_POST["version"])));exit;}global$b,$g,$l,$Lb,$Qb,$Yb,$m,$Gc,$Kc,$aa,$id,$x,$ba,$wd,$he,$Ge,$Qf,$Oc,$pg,$tg,$U,$Gg,$ca;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$aa=($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");$_e=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$aa);if(version_compare(PHP_VERSION,'5.2.0')>=0)$_e[]=true;call_user_func_array('session_set_cookie_params',$_e);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$sc);if(function_exists("get_magic_quotes_runtime")&&get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);function
get_lang(){return'en';}function
lang($sg,$ce=null){if(is_array($sg)){$Je=($ce==1?0:1);$sg=$sg[$Je];}$sg=str_replace("%d","%s",$sg);$ce=format_number($ce);return
sprintf($sg,$ce);}if(extension_loaded('pdo')){class
Min_PDO{var$_result,$server_info,$affected_rows,$errno,$error,$pdo;function
__construct(){global$b;$Je=array_search("SQL",$b->operators);if($Je!==false)unset($b->operators[$Je]);}function
dsn($Ob,$V,$E,$C=array()){$C[PDO::ATTR_ERRMODE]=PDO::ERRMODE_SILENT;$C[PDO::ATTR_STATEMENT_CLASS]=array('Min_PDOStatement');try{$this->pdo=new
PDO($Ob,$V,$E,$C);}catch(Exception$dc){auth_error(h($dc->getMessage()));}$this->server_info=@$this->pdo->getAttribute(PDO::ATTR_SERVER_VERSION);}function
quote($P){return$this->pdo->quote($P);}function
query($F,$Ag=false){$G=$this->pdo->query($F);$this->error="";if(!$G){list(,$this->errno,$this->error)=$this->pdo->errorInfo();if(!$this->error)$this->error='Unknown error.';return
false;}$this->store_result($G);return$G;}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result($G=null){if(!$G){$G=$this->_result;if(!$G)return
false;}if($G->columnCount()){$G->num_rows=$G->rowCount();return$G;}$this->affected_rows=$G->rowCount();return
true;}function
next_result(){if(!$this->_result)return
false;$this->_result->_offset=0;return@$this->_result->nextRowset();}function
result($F,$n=0){$G=$this->query($F);if(!$G)return
false;$I=$G->fetch();return$I[$n];}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(PDO::FETCH_ASSOC);}function
fetch_row(){return$this->fetch(PDO::FETCH_NUM);}function
fetch_field(){$I=(object)$this->getColumnMeta($this->_offset++);$I->orgtable=$I->table;$I->orgname=$I->name;$I->charsetnr=(in_array("blob",(array)$I->flags)?63:0);return$I;}}}$Lb=array();function
add_driver($t,$B){global$Lb;$Lb[$t]=$B;}class
Min_SQL{var$_conn;function
__construct($g){$this->_conn=$g;}function
select($Q,$K,$Z,$Hc,$pe=array(),$z=1,$D=0,$Oe=false){global$b,$x;$nd=(count($Hc)<count($K));$F=$b->selectQueryBuild($K,$Z,$Hc,$pe,$z,$D);if(!$F)$F="SELECT".limit(($_GET["page"]!="last"&&$z!=""&&$Hc&&$nd&&$x=="sql"?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$K)."\nFROM ".table($Q),($Z?"\nWHERE ".implode(" AND ",$Z):"").($Hc&&$nd?"\nGROUP BY ".implode(", ",$Hc):"").($pe?"\nORDER BY ".implode(", ",$pe):""),($z!=""?+$z:null),($D?$z*$D:0),"\n");$Nf=microtime(true);$H=$this->_conn->query($F);if($Oe)echo$b->selectQuery($F,$Nf,!$H);return$H;}function
delete($Q,$Ve,$z=0){$F="FROM ".table($Q);return
queries("DELETE".($z?limit1($Q,$F,$Ve):" $F$Ve"));}function
update($Q,$N,$Ve,$z=0,$L="\n"){$Og=array();foreach($N
as$y=>$X)$Og[]="$y = $X";$F=table($Q)." SET$L".implode(",$L",$Og);return
queries("UPDATE".($z?limit1($Q,$F,$Ve,$L):" $F$Ve"));}function
insert($Q,$N){return
queries("INSERT INTO ".table($Q).($N?" (".implode(", ",array_keys($N)).")\nVALUES (".implode(", ",$N).")":" DEFAULT VALUES"));}function
insertUpdate($Q,$J,$Me){return
false;}function
begin(){return
queries("BEGIN");}function
commit(){return
queries("COMMIT");}function
rollback(){return
queries("ROLLBACK");}function
slowQuery($F,$hg){}function
convertSearch($u,$X,$n){return$u;}function
value($X,$n){return(method_exists($this->_conn,'value')?$this->_conn->value($X,$n):(is_resource($X)?stream_get_contents($X):$X));}function
quoteBinary($of){return
q($of);}function
warnings(){return'';}function
tableHelp($B){}}$Lb["sqlite"]="SQLite 3";$Lb["sqlite2"]="SQLite 2";if(isset($_GET["sqlite"])||isset($_GET["sqlite2"])){define("DRIVER",(isset($_GET["sqlite"])?"sqlite":"sqlite2"));if(class_exists(isset($_GET["sqlite"])?"SQLite3":"SQLiteDatabase")){if(isset($_GET["sqlite"])){class
Min_SQLite{var$extension="SQLite3",$server_info,$affected_rows,$errno,$error,$_link;function
__construct($p){$this->_link=new
SQLite3($p);$Qg=$this->_link->version();$this->server_info=$Qg["versionString"];}function
query($F){$G=@$this->_link->query($F);$this->error="";if(!$G){$this->errno=$this->_link->lastErrorCode();$this->error=$this->_link->lastErrorMsg();return
false;}elseif($G->numColumns())return
new
Min_Result($G);$this->affected_rows=$this->_link->changes();return
true;}function
quote($P){return(is_utf8($P)?"'".$this->_link->escapeString($P)."'":"x'".reset(unpack('H*',$P))."'");}function
store_result(){return$this->_result;}function
result($F,$n=0){$G=$this->query($F);if(!is_object($G))return
false;$I=$G->_result->fetchArray();return$I[$n];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($G){$this->_result=$G;}function
fetch_assoc(){return$this->_result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->_result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$e=$this->_offset++;$T=$this->_result->columnType($e);return(object)array("name"=>$this->_result->columnName($e),"type"=>$T,"charsetnr"=>($T==SQLITE3_BLOB?63:0),);}function
__desctruct(){return$this->_result->finalize();}}}else{class
Min_SQLite{var$extension="SQLite",$server_info,$affected_rows,$error,$_link;function
__construct($p){$this->server_info=sqlite_libversion();$this->_link=new
SQLiteDatabase($p);}function
query($F,$Ag=false){$Sd=($Ag?"unbufferedQuery":"query");$G=@$this->_link->$Sd($F,SQLITE_BOTH,$m);$this->error="";if(!$G){$this->error=$m;return
false;}elseif($G===true){$this->affected_rows=$this->changes();return
true;}return
new
Min_Result($G);}function
quote($P){return"'".sqlite_escape_string($P)."'";}function
store_result(){return$this->_result;}function
result($F,$n=0){$G=$this->query($F);if(!is_object($G))return
false;$I=$G->_result->fetch();return$I[$n];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($G){$this->_result=$G;if(method_exists($G,'numRows'))$this->num_rows=$G->numRows();}function
fetch_assoc(){$I=$this->_result->fetch(SQLITE_ASSOC);if(!$I)return
false;$H=array();foreach($I
as$y=>$X)$H[idf_unescape($y)]=$X;return$H;}function
fetch_row(){return$this->_result->fetch(SQLITE_NUM);}function
fetch_field(){$B=$this->_result->fieldName($this->_offset++);$Ee='(\[.*]|"(?:[^"]|"")*"|(.+))';if(preg_match("~^($Ee\\.)?$Ee\$~",$B,$A)){$Q=($A[3]!=""?$A[3]:idf_unescape($A[2]));$B=($A[5]!=""?$A[5]:idf_unescape($A[4]));}return(object)array("name"=>$B,"orgname"=>$B,"orgtable"=>$Q,);}}}}elseif(extension_loaded("pdo_sqlite")){class
Min_SQLite
extends
Min_PDO{var$extension="PDO_SQLite";function
__construct($p){$this->dsn(DRIVER.":$p","","");}}}if(class_exists("Min_SQLite")){class
Min_DB
extends
Min_SQLite{function
__construct(){parent::__construct(":memory:");$this->query("PRAGMA foreign_keys = 1");}function
select_db($p){if(is_readable($p)&&$this->query("ATTACH ".$this->quote(preg_match("~(^[/\\\\]|:)~",$p)?$p:dirname($_SERVER["SCRIPT_FILENAME"])."/$p")." AS a")){parent::__construct($p);$this->query("PRAGMA foreign_keys = 1");$this->query("PRAGMA busy_timeout = 500");return
true;}return
false;}function
multi_query($F){return$this->_result=$this->query($F);}function
next_result(){return
false;}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$J,$Me){$Og=array();foreach($J
as$N)$Og[]="(".implode(", ",$N).")";return
queries("REPLACE INTO ".table($Q)." (".implode(", ",array_keys(reset($J))).") VALUES\n".implode(",\n",$Og));}function
tableHelp($B){if($B=="sqlite_sequence")return"fileformat2.html#seqtab";if($B=="sqlite_master")return"fileformat2.html#$B";}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b;list(,,$E)=$b->credentials();if($E!="")return'Database does not support password.';return
new
Min_DB;}function
get_databases(){return
array();}function
limit($F,$Z,$z,$ee=0,$L=" "){return" $F$Z".($z!==null?$L."LIMIT $z".($ee?" OFFSET $ee":""):"");}function
limit1($Q,$F,$Z,$L="\n"){global$g;return(preg_match('~^INTO~',$F)||$g->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($F,$Z,1,0,$L):" $F WHERE rowid = (SELECT rowid FROM ".table($Q).$Z.$L."LIMIT 1)");}function
db_collation($k,$ab){global$g;return$g->result("PRAGMA encoding");}function
engines(){return
array();}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");}function
count_tables($j){return
array();}function
table_status($B=""){global$g;$H=array();foreach(get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') ".($B!=""?"AND name = ".q($B):"ORDER BY name"))as$I){$I["Rows"]=$g->result("SELECT COUNT(*) FROM ".idf_escape($I["Name"]));$H[$I["Name"]]=$I;}foreach(get_rows("SELECT * FROM sqlite_sequence",null,"")as$I)$H[$I["name"]]["Auto_increment"]=$I["seq"];return($B!=""?$H[$B]:$H);}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){global$g;return!$g->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($Q){global$g;$H=array();$Me="";foreach(get_rows("PRAGMA table_info(".table($Q).")")as$I){$B=$I["name"];$T=strtolower($I["type"]);$Cb=$I["dflt_value"];$H[$B]=array("field"=>$B,"type"=>(preg_match('~int~i',$T)?"integer":(preg_match('~char|clob|text~i',$T)?"text":(preg_match('~blob~i',$T)?"blob":(preg_match('~real|floa|doub~i',$T)?"real":"numeric")))),"full_type"=>$T,"default"=>(preg_match("~'(.*)'~",$Cb,$A)?str_replace("''","'",$A[1]):($Cb=="NULL"?null:$Cb)),"null"=>!$I["notnull"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1),"primary"=>$I["pk"],);if($I["pk"]){if($Me!="")$H[$Me]["auto_increment"]=false;elseif(preg_match('~^integer$~i',$T))$H[$B]["auto_increment"]=true;$Me=$B;}}$Kf=$g->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));preg_match_all('~(("[^"]*+")+|[a-z0-9_]+)\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i',$Kf,$Kd,PREG_SET_ORDER);foreach($Kd
as$A){$B=str_replace('""','"',preg_replace('~^"|"$~','',$A[1]));if($H[$B])$H[$B]["collation"]=trim($A[3],"'");}return$H;}function
indexes($Q,$h=null){global$g;if(!is_object($h))$h=$g;$H=array();$Kf=$h->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));if(preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i',$Kf,$A)){$H[""]=array("type"=>"PRIMARY","columns"=>array(),"lengths"=>array(),"descs"=>array());preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i',$A[1],$Kd,PREG_SET_ORDER);foreach($Kd
as$A){$H[""]["columns"][]=idf_unescape($A[2]).$A[4];$H[""]["descs"][]=(preg_match('~DESC~i',$A[5])?'1':null);}}if(!$H){foreach(fields($Q)as$B=>$n){if($n["primary"])$H[""]=array("type"=>"PRIMARY","columns"=>array($B),"lengths"=>array(),"descs"=>array(null));}}$Lf=get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = ".q($Q),$h);foreach(get_rows("PRAGMA index_list(".table($Q).")",$h)as$I){$B=$I["name"];$v=array("type"=>($I["unique"]?"UNIQUE":"INDEX"));$v["lengths"]=array();$v["descs"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($B).")",$h)as$nf){$v["columns"][]=$nf["name"];$v["descs"][]=null;}if(preg_match('~^CREATE( UNIQUE)? INDEX '.preg_quote(idf_escape($B).' ON '.idf_escape($Q),'~').' \((.*)\)$~i',$Lf[$B],$bf)){preg_match_all('/("[^"]*+")+( DESC)?/',$bf[2],$Kd);foreach($Kd[2]as$y=>$X){if($X)$v["descs"][$y]='1';}}if(!$H[""]||$v["type"]!="UNIQUE"||$v["columns"]!=$H[""]["columns"]||$v["descs"]!=$H[""]["descs"]||!preg_match("~^sqlite_~",$B))$H[$B]=$v;}return$H;}function
foreign_keys($Q){$H=array();foreach(get_rows("PRAGMA foreign_key_list(".table($Q).")")as$I){$q=&$H[$I["id"]];if(!$q)$q=$I;$q["source"][]=$I["from"];$q["target"][]=$I["to"];}return$H;}function
view($B){global$g;return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU','',$g->result("SELECT sql FROM sqlite_master WHERE name = ".q($B))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($k){return
false;}function
error(){global$g;return
h($g->error);}function
check_sqlite_name($B){global$g;$jc="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($jc)\$~",$B)){$g->error=sprintf('Please use one of the extensions %s.',str_replace("|",", ",$jc));return
false;}return
true;}function
create_database($k,$d){global$g;if(file_exists($k)){$g->error='File exists.';return
false;}if(!check_sqlite_name($k))return
false;try{$_=new
Min_SQLite($k);}catch(Exception$dc){$g->error=$dc->getMessage();return
false;}$_->query('PRAGMA encoding = "UTF-8"');$_->query('CREATE TABLE adminer (i)');$_->query('DROP TABLE adminer');return
true;}function
drop_databases($j){global$g;$g->__construct(":memory:");foreach($j
as$k){if(!@unlink($k)){$g->error='File exists.';return
false;}}return
true;}function
rename_database($B,$d){global$g;if(!check_sqlite_name($B))return
false;$g->__construct(":memory:");$g->error='File exists.';return@rename(DB,$B);}function
auto_increment(){return" PRIMARY KEY".(DRIVER=="sqlite"?" AUTOINCREMENT":"");}function
alter_table($Q,$B,$o,$zc,$fb,$Xb,$d,$Da,$Be){global$g;$Kg=($Q==""||$zc);foreach($o
as$n){if($n[0]!=""||!$n[1]||$n[2]){$Kg=true;break;}}$c=array();$ue=array();foreach($o
as$n){if($n[1]){$c[]=($Kg?$n[1]:"ADD ".implode($n[1]));if($n[0]!="")$ue[$n[0]]=$n[1][0];}}if(!$Kg){foreach($c
as$X){if(!queries("ALTER TABLE ".table($Q)." $X"))return
false;}if($Q!=$B&&!queries("ALTER TABLE ".table($Q)." RENAME TO ".table($B)))return
false;}elseif(!recreate_table($Q,$B,$c,$ue,$zc,$Da))return
false;if($Da){queries("BEGIN");queries("UPDATE sqlite_sequence SET seq = $Da WHERE name = ".q($B));if(!$g->affected_rows)queries("INSERT INTO sqlite_sequence (name, seq) VALUES (".q($B).", $Da)");queries("COMMIT");}return
true;}function
recreate_table($Q,$B,$o,$ue,$zc,$Da,$w=array()){global$g;if($Q!=""){if(!$o){foreach(fields($Q)as$y=>$n){if($w)$n["auto_increment"]=0;$o[]=process_field($n,$n);$ue[$y]=idf_escape($y);}}$Ne=false;foreach($o
as$n){if($n[6])$Ne=true;}$Nb=array();foreach($w
as$y=>$X){if($X[2]=="DROP"){$Nb[$X[1]]=true;unset($w[$y]);}}foreach(indexes($Q)as$rd=>$v){$f=array();foreach($v["columns"]as$y=>$e){if(!$ue[$e])continue
2;$f[]=$ue[$e].($v["descs"][$y]?" DESC":"");}if(!$Nb[$rd]){if($v["type"]!="PRIMARY"||!$Ne)$w[]=array($v["type"],$rd,$f);}}foreach($w
as$y=>$X){if($X[0]=="PRIMARY"){unset($w[$y]);$zc[]="  PRIMARY KEY (".implode(", ",$X[2]).")";}}foreach(foreign_keys($Q)as$rd=>$q){foreach($q["source"]as$y=>$e){if(!$ue[$e])continue
2;$q["source"][$y]=idf_unescape($ue[$e]);}if(!isset($zc[" $rd"]))$zc[]=" ".format_foreign_key($q);}queries("BEGIN");}foreach($o
as$y=>$n)$o[$y]="  ".implode($n);$o=array_merge($o,array_filter($zc));$bg=($Q==$B?"adminer_$B":$B);if(!queries("CREATE TABLE ".table($bg)." (\n".implode(",\n",$o)."\n)"))return
false;if($Q!=""){if($ue&&!queries("INSERT INTO ".table($bg)." (".implode(", ",$ue).") SELECT ".implode(", ",array_map('idf_escape',array_keys($ue)))." FROM ".table($Q)))return
false;$zg=array();foreach(triggers($Q)as$xg=>$ig){$wg=trigger($xg);$zg[]="CREATE TRIGGER ".idf_escape($xg)." ".implode(" ",$ig)." ON ".table($B)."\n$wg[Statement]";}$Da=$Da?0:$g->result("SELECT seq FROM sqlite_sequence WHERE name = ".q($Q));if(!queries("DROP TABLE ".table($Q))||($Q==$B&&!queries("ALTER TABLE ".table($bg)." RENAME TO ".table($B)))||!alter_indexes($B,$w))return
false;if($Da)queries("UPDATE sqlite_sequence SET seq = $Da WHERE name = ".q($B));foreach($zg
as$wg){if(!queries($wg))return
false;}queries("COMMIT");}return
true;}function
index_sql($Q,$T,$B,$f){return"CREATE $T ".($T!="INDEX"?"INDEX ":"").idf_escape($B!=""?$B:uniqid($Q."_"))." ON ".table($Q)." $f";}function
alter_indexes($Q,$c){foreach($c
as$Me){if($Me[0]=="PRIMARY")return
recreate_table($Q,$Q,array(),array(),array(),0,$c);}foreach(array_reverse($c)as$X){if(!queries($X[2]=="DROP"?"DROP INDEX ".idf_escape($X[1]):index_sql($Q,$X[0],$X[1],"(".implode(", ",$X[2]).")")))return
false;}return
true;}function
truncate_tables($S){return
apply_queries("DELETE FROM",$S);}function
drop_views($Sg){return
apply_queries("DROP VIEW",$Sg);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
move_tables($S,$Sg,$ag){return
false;}function
trigger($B){global$g;if($B=="")return
array("Statement"=>"BEGIN\n\t;\nEND");$u='(?:[^`"\s]+|`[^`]*`|"[^"]*")+';$yg=trigger_options();preg_match("~^CREATE\\s+TRIGGER\\s*$u\\s*(".implode("|",$yg["Timing"]).")\\s+([a-z]+)(?:\\s+OF\\s+($u))?\\s+ON\\s*$u\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is",$g->result("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = ".q($B)),$A);$de=$A[3];return
array("Timing"=>strtoupper($A[1]),"Event"=>strtoupper($A[2]).($de?" OF":""),"Of"=>idf_unescape($de),"Trigger"=>$B,"Statement"=>$A[4],);}function
triggers($Q){$H=array();$yg=trigger_options();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q))as$I){preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*('.implode("|",$yg["Timing"]).')\s*(.*?)\s+ON\b~i',$I["sql"],$A);$H[$I["name"]]=array($A[1],$A[2]);}return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
begin(){return
queries("BEGIN");}function
last_id(){global$g;return$g->result("SELECT LAST_INSERT_ROWID()");}function
explain($g,$F){return$g->query("EXPLAIN QUERY PLAN $F");}function
found_rows($R,$Z){}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($qf){return
true;}function
create_sql($Q,$Da,$Rf){global$g;$H=$g->result("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = ".q($Q));foreach(indexes($Q)as$B=>$v){if($B=='')continue;$H.=";\n\n".index_sql($Q,$v['type'],$B,"(".implode(", ",array_map('idf_escape',$v['columns'])).")");}return$H;}function
truncate_sql($Q){return"DELETE FROM ".table($Q);}function
use_sql($i){}function
trigger_sql($Q){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q)));}function
show_variables(){global$g;$H=array();foreach(array("auto_vacuum","cache_size","count_changes","default_cache_size","empty_result_callbacks","encoding","foreign_keys","full_column_names","fullfsync","journal_mode","journal_size_limit","legacy_file_format","locking_mode","page_size","max_page_count","read_uncommitted","recursive_triggers","reverse_unordered_selects","secure_delete","short_column_names","synchronous","temp_store","temp_store_directory","schema_version","integrity_check","quick_check")as$y)$H[$y]=$g->result("PRAGMA $y");return$H;}function
show_status(){$H=array();foreach(get_vals("PRAGMA compile_options")as$ne){list($y,$X)=explode("=",$ne,2);$H[$y]=$X;}return$H;}function
convert_field($n){}function
unconvert_field($n,$H){return$H;}function
support($nc){return
preg_match('~^(columns|database|drop_col|dump|indexes|descidx|move_col|sql|status|table|trigger|variables|view|view_trigger)$~',$nc);}function
driver_config(){$U=array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0);return
array('possible_drivers'=>array((isset($_GET["sqlite"])?"SQLite3":"SQLite"),"PDO_SQLite"),'jush'=>"sqlite",'types'=>$U,'structured_types'=>array_keys($U),'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL"),'functions'=>array("hex","length","lower","round","unixepoch","upper"),'grouping'=>array("avg","count","count distinct","group_concat","max","min","sum"),'edit_functions'=>array(array(),array("integer|real|numeric"=>"+/-","text"=>"||",)),);}}$Lb["pgsql"]="PostgreSQL";if(isset($_GET["pgsql"])){define("DRIVER","pgsql");if(extension_loaded("pgsql")){class
Min_DB{var$extension="PgSQL",$_link,$_result,$_string,$_database=true,$server_info,$affected_rows,$error,$timeout;function
_error($ac,$m){if(ini_bool("html_errors"))$m=html_entity_decode(strip_tags($m));$m=preg_replace('~^[^:]*: ~','',$m);$this->error=$m;}function
connect($M,$V,$E){global$b;$k=$b->database();set_error_handler(array($this,'_error'));$this->_string="host='".str_replace(":","' port='",addcslashes($M,"'\\"))."' user='".addcslashes($V,"'\\")."' password='".addcslashes($E,"'\\")."'";$this->_link=@pg_connect("$this->_string dbname='".($k!=""?addcslashes($k,"'\\"):"postgres")."'",PGSQL_CONNECT_FORCE_NEW);if(!$this->_link&&$k!=""){$this->_database=false;$this->_link=@pg_connect("$this->_string dbname='postgres'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->_link){$Qg=pg_version($this->_link);$this->server_info=$Qg["server"];pg_set_client_encoding($this->_link,"UTF8");}return(bool)$this->_link;}function
quote($P){return"'".pg_escape_string($this->_link,$P)."'";}function
value($X,$n){return($n["type"]=="bytea"&&$X!==null?pg_unescape_bytea($X):$X);}function
quoteBinary($P){return"'".pg_escape_bytea($this->_link,$P)."'";}function
select_db($i){global$b;if($i==$b->database())return$this->_database;$H=@pg_connect("$this->_string dbname='".addcslashes($i,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($H)$this->_link=$H;return$H;}function
close(){$this->_link=@pg_connect("$this->_string dbname='postgres'");}function
query($F,$Ag=false){$G=@pg_query($this->_link,$F);$this->error="";if(!$G){$this->error=pg_last_error($this->_link);$H=false;}elseif(!pg_num_fields($G)){$this->affected_rows=pg_affected_rows($G);$H=true;}else$H=new
Min_Result($G);if($this->timeout){$this->timeout=0;$this->query("RESET statement_timeout");}return$H;}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$n=0){$G=$this->query($F);if(!$G||!$G->num_rows)return
false;return
pg_fetch_result($G->_result,0,$n);}function
warnings(){return
h(pg_last_notice($this->_link));}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($G){$this->_result=$G;$this->num_rows=pg_num_rows($G);}function
fetch_assoc(){return
pg_fetch_assoc($this->_result);}function
fetch_row(){return
pg_fetch_row($this->_result);}function
fetch_field(){$e=$this->_offset++;$H=new
stdClass;if(function_exists('pg_field_table'))$H->orgtable=pg_field_table($this->_result,$e);$H->name=pg_field_name($this->_result,$e);$H->orgname=$H->name;$H->type=pg_field_type($this->_result,$e);$H->charsetnr=($H->type=="bytea"?63:0);return$H;}function
__destruct(){pg_free_result($this->_result);}}}elseif(extension_loaded("pdo_pgsql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_PgSQL",$timeout;function
connect($M,$V,$E){global$b;$k=$b->database();$this->dsn("pgsql:host='".str_replace(":","' port='",addcslashes($M,"'\\"))."' client_encoding=utf8 dbname='".($k!=""?addcslashes($k,"'\\"):"postgres")."'",$V,$E);return
true;}function
select_db($i){global$b;return($b->database()==$i);}function
quoteBinary($of){return
q($of);}function
query($F,$Ag=false){$H=parent::query($F,$Ag);if($this->timeout){$this->timeout=0;parent::query("RESET statement_timeout");}return$H;}function
warnings(){return'';}function
close(){}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$J,$Me){global$g;foreach($J
as$N){$Hg=array();$Z=array();foreach($N
as$y=>$X){$Hg[]="$y = $X";if(isset($Me[idf_unescape($y)]))$Z[]="$y = $X";}if(!(($Z&&queries("UPDATE ".table($Q)." SET ".implode(", ",$Hg)." WHERE ".implode(" AND ",$Z))&&$g->affected_rows)||queries("INSERT INTO ".table($Q)." (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).")")))return
false;}return
true;}function
slowQuery($F,$hg){$this->_conn->query("SET statement_timeout = ".(1000*$hg));$this->_conn->timeout=1000*$hg;return$F;}function
convertSearch($u,$X,$n){return(preg_match('~char|text'.(!preg_match('~LIKE~',$X["op"])?'|date|time(stamp)?|boolean|uuid|'.number_type():'').'~',$n["type"])?$u:"CAST($u AS text)");}function
quoteBinary($of){return$this->_conn->quoteBinary($of);}function
warnings(){return$this->_conn->warnings();}function
tableHelp($B){$Cd=array("information_schema"=>"infoschema","pg_catalog"=>"catalog",);$_=$Cd[$_GET["ns"]];if($_)return"$_-".str_replace("_","-",$B).".html";}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b,$U,$Qf;$g=new
Min_DB;$vb=$b->credentials();if($g->connect($vb[0],$vb[1],$vb[2])){if(min_version(9,0,$g)){$g->query("SET application_name = 'Adminer'");if(min_version(9.2,0,$g)){$Qf['Strings'][]="json";$U["json"]=4294967295;if(min_version(9.4,0,$g)){$Qf['Strings'][]="jsonb";$U["jsonb"]=4294967295;}}}return$g;}return$g->error;}function
get_databases(){return
get_vals("SELECT datname FROM pg_database WHERE has_database_privilege(datname, 'CONNECT') ORDER BY datname");}function
limit($F,$Z,$z,$ee=0,$L=" "){return" $F$Z".($z!==null?$L."LIMIT $z".($ee?" OFFSET $ee":""):"");}function
limit1($Q,$F,$Z,$L="\n"){return(preg_match('~^INTO~',$F)?limit($F,$Z,1,0,$L):" $F".(is_view(table_status1($Q))?$Z:" WHERE ctid = (SELECT ctid FROM ".table($Q).$Z.$L."LIMIT 1)"));}function
db_collation($k,$ab){global$g;return$g->result("SELECT datcollate FROM pg_database WHERE datname = ".q($k));}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT user");}function
tables_list(){$F="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";if(support('materializedview'))$F.="
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";$F.="
ORDER BY 1";return
get_key_vals($F);}function
count_tables($j){return
array();}function
table_status($B=""){$H=array();foreach(get_rows("SELECT c.relname AS \"Name\", CASE c.relkind WHEN 'r' THEN 'table' WHEN 'm' THEN 'materialized view' ELSE 'view' END AS \"Engine\", pg_relation_size(c.oid) AS \"Data_length\", pg_total_relation_size(c.oid) - pg_relation_size(c.oid) AS \"Index_length\", obj_description(c.oid, 'pg_class') AS \"Comment\", ".(min_version(12)?"''":"CASE WHEN c.relhasoids THEN 'oid' ELSE '' END")." AS \"Oid\", c.reltuples as \"Rows\", n.nspname
FROM pg_class c
JOIN pg_namespace n ON(n.nspname = current_schema() AND n.oid = c.relnamespace)
WHERE relkind IN ('r', 'm', 'v', 'f', 'p')
".($B!=""?"AND relname = ".q($B):"ORDER BY relname"))as$I)$H[$I["Name"]]=$I;return($B!=""?$H[$B]:$H);}function
is_view($R){return
in_array($R["Engine"],array("view","materialized view"));}function
fk_support($R){return
true;}function
fields($Q){$H=array();$va=array('timestamp without time zone'=>'timestamp','timestamp with time zone'=>'timestamptz',);foreach(get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, pg_get_expr(d.adbin, d.adrelid) AS default, a.attnotnull::int, col_description(c.oid, a.attnum) AS comment".(min_version(10)?", a.attidentity":"")."
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = ".q($Q)."
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$I){preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~',$I["full_type"],$A);list(,$T,$_d,$I["length"],$ra,$xa)=$A;$I["length"].=$xa;$Sa=$T.$ra;if(isset($va[$Sa])){$I["type"]=$va[$Sa];$I["full_type"]=$I["type"].$_d.$xa;}else{$I["type"]=$T;$I["full_type"]=$I["type"].$_d.$ra.$xa;}if(in_array($I['attidentity'],array('a','d')))$I['default']='GENERATED '.($I['attidentity']=='d'?'BY DEFAULT':'ALWAYS').' AS IDENTITY';$I["null"]=!$I["attnotnull"];$I["auto_increment"]=$I['attidentity']||preg_match('~^nextval\(~i',$I["default"]);$I["privileges"]=array("insert"=>1,"select"=>1,"update"=>1);if(preg_match('~(.+)::[^,)]+(.*)~',$I["default"],$A))$I["default"]=($A[1]=="NULL"?null:idf_unescape($A[1]).$A[2]);$H[$I["field"]]=$I;}return$H;}function
indexes($Q,$h=null){global$g;if(!is_object($h))$h=$g;$H=array();$Yf=$h->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($Q));$f=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $Yf AND attnum > 0",$h);foreach(get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption, (indpred IS NOT NULL)::int as indispartial FROM pg_index i, pg_class ci WHERE i.indrelid = $Yf AND ci.oid = i.indexrelid",$h)as$I){$cf=$I["relname"];$H[$cf]["type"]=($I["indispartial"]?"INDEX":($I["indisprimary"]?"PRIMARY":($I["indisunique"]?"UNIQUE":"INDEX")));$H[$cf]["columns"]=array();foreach(explode(" ",$I["indkey"])as$ed)$H[$cf]["columns"][]=$f[$ed];$H[$cf]["descs"]=array();foreach(explode(" ",$I["indoption"])as$fd)$H[$cf]["descs"][]=($fd&1?'1':null);$H[$cf]["lengths"]=array();}return$H;}function
foreign_keys($Q){global$he;$H=array();foreach(get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = (SELECT pc.oid FROM pg_class AS pc INNER JOIN pg_namespace AS pn ON (pn.oid = pc.relnamespace) WHERE pc.relname = ".q($Q)." AND pn.nspname = current_schema())
AND contype = 'f'::char
ORDER BY conkey, conname")as$I){if(preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA',$I['definition'],$A)){$I['source']=array_map('idf_unescape',array_map('trim',explode(',',$A[1])));if(preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~',$A[2],$Jd)){$I['ns']=idf_unescape($Jd[2]);$I['table']=idf_unescape($Jd[4]);}$I['target']=array_map('idf_unescape',array_map('trim',explode(',',$A[3])));$I['on_delete']=(preg_match("~ON DELETE ($he)~",$A[4],$Jd)?$Jd[1]:'NO ACTION');$I['on_update']=(preg_match("~ON UPDATE ($he)~",$A[4],$Jd)?$Jd[1]:'NO ACTION');$H[$I['conname']]=$I;}}return$H;}function
constraints($Q){global$he;$H=array();foreach(get_rows("SELECT conname, consrc
FROM pg_catalog.pg_constraint
INNER JOIN pg_catalog.pg_namespace ON pg_constraint.connamespace = pg_namespace.oid
INNER JOIN pg_catalog.pg_class ON pg_constraint.conrelid = pg_class.oid AND pg_constraint.connamespace = pg_class.relnamespace
WHERE pg_constraint.contype = 'c'
AND conrelid != 0 -- handle only CONSTRAINTs here, not TYPES
AND nspname = current_schema()
AND relname = ".q($Q)."
ORDER BY connamespace, conname")as$I)$H[$I['conname']]=$I['consrc'];return$H;}function
view($B){global$g;return
array("select"=>trim($g->result("SELECT pg_get_viewdef(".$g->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($B)).")")));}function
collations(){return
array();}function
information_schema($k){return($k=="information_schema");}function
error(){global$g;$H=h($g->error);if(preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s',$H,$A))$H=$A[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($A[3]).'})(.*)~','\1<b>\2</b>',$A[2]).$A[4];return
nl_br($H);}function
create_database($k,$d){return
queries("CREATE DATABASE ".idf_escape($k).($d?" ENCODING ".idf_escape($d):""));}function
drop_databases($j){global$g;$g->close();return
apply_queries("DROP DATABASE",$j,'idf_escape');}function
rename_database($B,$d){return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($B));}function
auto_increment(){return"";}function
alter_table($Q,$B,$o,$zc,$fb,$Xb,$d,$Da,$Be){$c=array();$Ue=array();if($Q!=""&&$Q!=$B)$Ue[]="ALTER TABLE ".table($Q)." RENAME TO ".table($B);foreach($o
as$n){$e=idf_escape($n[0]);$X=$n[1];if(!$X)$c[]="DROP $e";else{$Ng=$X[5];unset($X[5]);if($n[0]==""){if(isset($X[6]))$X[1]=($X[1]==" bigint"?" big":($X[1]==" smallint"?" small":" "))."serial";$c[]=($Q!=""?"ADD ":"  ").implode($X);if(isset($X[6]))$c[]=($Q!=""?"ADD":" ")." PRIMARY KEY ($X[0])";}else{if($e!=$X[0])$Ue[]="ALTER TABLE ".table($B)." RENAME $e TO $X[0]";$c[]="ALTER $e TYPE$X[1]";if(!$X[6]){$c[]="ALTER $e ".($X[3]?"SET$X[3]":"DROP DEFAULT");$c[]="ALTER $e ".($X[2]==" NULL"?"DROP NOT":"SET").$X[2];}}if($n[0]!=""||$Ng!="")$Ue[]="COMMENT ON COLUMN ".table($B).".$X[0] IS ".($Ng!=""?substr($Ng,9):"''");}}$c=array_merge($c,$zc);if($Q=="")array_unshift($Ue,"CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)");elseif($c)array_unshift($Ue,"ALTER TABLE ".table($Q)."\n".implode(",\n",$c));if($Q!=""||$fb!="")$Ue[]="COMMENT ON TABLE ".table($B)." IS ".q($fb);if($Da!=""){}foreach($Ue
as$F){if(!queries($F))return
false;}return
true;}function
alter_indexes($Q,$c){$tb=array();$Mb=array();$Ue=array();foreach($c
as$X){if($X[0]!="INDEX")$tb[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$Mb[]=idf_escape($X[1]);else$Ue[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q)." (".implode(", ",$X[2]).")";}if($tb)array_unshift($Ue,"ALTER TABLE ".table($Q).implode(",",$tb));if($Mb)array_unshift($Ue,"DROP INDEX ".implode(", ",$Mb));foreach($Ue
as$F){if(!queries($F))return
false;}return
true;}function
truncate_tables($S){return
queries("TRUNCATE ".implode(", ",array_map('table',$S)));return
true;}function
drop_views($Sg){return
drop_tables($Sg);}function
drop_tables($S){foreach($S
as$Q){$O=table_status($Q);if(!queries("DROP ".strtoupper($O["Engine"])." ".table($Q)))return
false;}return
true;}function
move_tables($S,$Sg,$ag){foreach(array_merge($S,$Sg)as$Q){$O=table_status($Q);if(!queries("ALTER ".strtoupper($O["Engine"])." ".table($Q)." SET SCHEMA ".idf_escape($ag)))return
false;}return
true;}function
trigger($B,$Q){if($B=="")return
array("Statement"=>"EXECUTE PROCEDURE ()");$f=array();$Z="WHERE trigger_schema = current_schema() AND event_object_table = ".q($Q)." AND trigger_name = ".q($B);foreach(get_rows("SELECT * FROM information_schema.triggered_update_columns $Z")as$I)$f[]=$I["event_object_column"];$H=array();foreach(get_rows('SELECT trigger_name AS "Trigger", action_timing AS "Timing", event_manipulation AS "Event", \'FOR EACH \' || action_orientation AS "Type", action_statement AS "Statement" FROM information_schema.triggers '."$Z ORDER BY event_manipulation DESC")as$I){if($f&&$I["Event"]=="UPDATE")$I["Event"].=" OF";$I["Of"]=implode(", ",$f);if($H)$I["Event"].=" OR $H[Event]";$H=$I;}return$H;}function
triggers($Q){$H=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE trigger_schema = current_schema() AND event_object_table = ".q($Q))as$I){$wg=trigger($I["trigger_name"],$Q);$H[$wg["Trigger"]]=array($wg["Timing"],$wg["Event"]);}return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE","INSERT OR UPDATE","INSERT OR UPDATE OF","DELETE OR INSERT","DELETE OR UPDATE","DELETE OR UPDATE OF","DELETE OR INSERT OR UPDATE","DELETE OR INSERT OR UPDATE OF"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
routine($B,$T){$J=get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = '.q($B));$H=$J[0];$H["returns"]=array("type"=>$H["type_udt_name"]);$H["fields"]=get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = '.q($B).'
ORDER BY ordinal_position');return$H;}function
routines(){return
get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');}function
routine_languages(){return
get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");}function
routine_id($B,$I){$H=array();foreach($I["fields"]as$n)$H[]=$n["type"];return
idf_escape($B)."(".implode(", ",$H).")";}function
last_id(){return
0;}function
explain($g,$F){return$g->query("EXPLAIN $F");}function
found_rows($R,$Z){global$g;if(preg_match("~ rows=([0-9]+)~",$g->result("EXPLAIN SELECT * FROM ".idf_escape($R["Name"]).($Z?" WHERE ".implode(" AND ",$Z):"")),$bf))return$bf[1];return
false;}function
types(){return
get_vals("SELECT typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");}function
get_schema(){global$g;return$g->result("SELECT current_schema()");}function
set_schema($pf,$h=null){global$g,$U,$Qf;if(!$h)$h=$g;$H=$h->query("SET search_path TO ".idf_escape($pf));foreach(types()as$T){if(!isset($U[$T])){$U[$T]=0;$Qf['User types'][]=$T;}}return$H;}function
foreign_keys_sql($Q){$H="";$O=table_status($Q);$wc=foreign_keys($Q);ksort($wc);foreach($wc
as$vc=>$uc)$H.="ALTER TABLE ONLY ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." ADD CONSTRAINT ".idf_escape($vc)." $uc[definition] ".($uc['deferrable']?'DEFERRABLE':'NOT DEFERRABLE').";\n";return($H?"$H\n":$H);}function
create_sql($Q,$Da,$Rf){global$g;$H='';$lf=array();$yf=array();$O=table_status($Q);if(is_view($O)){$Rg=view($Q);return
rtrim("CREATE VIEW ".idf_escape($Q)." AS $Rg[select]",";");}$o=fields($Q);$w=indexes($Q);ksort($w);$ob=constraints($Q);if(!$O||empty($o))return
false;$H="CREATE TABLE ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." (\n    ";foreach($o
as$oc=>$n){$Ae=idf_escape($n['field']).' '.$n['full_type'].default_value($n).($n['attnotnull']?" NOT NULL":"");$lf[]=$Ae;if(preg_match('~nextval\(\'([^\']+)\'\)~',$n['default'],$Kd)){$xf=$Kd[1];$Jf=reset(get_rows(min_version(10)?"SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = ".q($xf):"SELECT * FROM $xf"));$yf[]=($Rf=="DROP+CREATE"?"DROP SEQUENCE IF EXISTS $xf;\n":"")."CREATE SEQUENCE $xf INCREMENT $Jf[increment_by] MINVALUE $Jf[min_value] MAXVALUE $Jf[max_value]".($Da&&$Jf['last_value']?" START $Jf[last_value]":"")." CACHE $Jf[cache_value];";}}if(!empty($yf))$H=implode("\n\n",$yf)."\n\n$H";foreach($w
as$Zc=>$v){switch($v['type']){case'UNIQUE':$lf[]="CONSTRAINT ".idf_escape($Zc)." UNIQUE (".implode(', ',array_map('idf_escape',$v['columns'])).")";break;case'PRIMARY':$lf[]="CONSTRAINT ".idf_escape($Zc)." PRIMARY KEY (".implode(', ',array_map('idf_escape',$v['columns'])).")";break;}}foreach($ob
as$kb=>$mb)$lf[]="CONSTRAINT ".idf_escape($kb)." CHECK $mb";$H.=implode(",\n    ",$lf)."\n) WITH (oids = ".($O['Oid']?'true':'false').");";foreach($w
as$Zc=>$v){if($v['type']=='INDEX'){$f=array();foreach($v['columns']as$y=>$X)$f[]=idf_escape($X).($v['descs'][$y]?" DESC":"");$H.="\n\nCREATE INDEX ".idf_escape($Zc)." ON ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." USING btree (".implode(', ',$f).");";}}if($O['Comment'])$H.="\n\nCOMMENT ON TABLE ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." IS ".q($O['Comment']).";";foreach($o
as$oc=>$n){if($n['comment'])$H.="\n\nCOMMENT ON COLUMN ".idf_escape($O['nspname']).".".idf_escape($O['Name']).".".idf_escape($oc)." IS ".q($n['comment']).";";}return
rtrim($H,';');}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
trigger_sql($Q){$O=table_status($Q);$H="";foreach(triggers($Q)as$vg=>$ug){$wg=trigger($vg,$O['Name']);$H.="\nCREATE TRIGGER ".idf_escape($wg['Trigger'])." $wg[Timing] $wg[Event] ON ".idf_escape($O["nspname"]).".".idf_escape($O['Name'])." $wg[Type] $wg[Statement];;\n";}return$H;}function
use_sql($i){return"\connect ".idf_escape($i);}function
show_variables(){return
get_key_vals("SHOW ALL");}function
process_list(){return
get_rows("SELECT * FROM pg_stat_activity ORDER BY ".(min_version(9.2)?"pid":"procpid"));}function
show_status(){}function
convert_field($n){}function
unconvert_field($n,$H){return$H;}function
support($nc){return
preg_match('~^(database|table|columns|sql|indexes|descidx|comment|view|'.(min_version(9.3)?'materializedview|':'').'scheme|routine|processlist|sequence|trigger|type|variables|drop_col|kill|dump)$~',$nc);}function
kill_process($X){return
queries("SELECT pg_terminate_backend(".number($X).")");}function
connection_id(){return"SELECT pg_backend_pid()";}function
max_connections(){global$g;return$g->result("SHOW max_connections");}function
driver_config(){$U=array();$Qf=array();foreach(array('Numbers'=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),'Date and time'=>array("date"=>13,"time"=>17,"timestamp"=>20,"timestamptz"=>21,"interval"=>0),'Strings'=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),'Binary'=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),'Network'=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"txid_snapshot"=>0),'Geometry'=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),)as$y=>$X){$U+=$X;$Qf[$y]=array_keys($X);}return
array('possible_drivers'=>array("PgSQL","PDO_PgSQL"),'jush'=>"pgsql",'types'=>$U,'structured_types'=>$Qf,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","ILIKE","ILIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL"),'functions'=>array("char_length","lower","round","to_hex","to_timestamp","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("char"=>"md5","date|time"=>"now",),array(number_type()=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",)),);}}$Lb["oracle"]="Oracle (beta)";if(isset($_GET["oracle"])){define("DRIVER","oracle");if(extension_loaded("oci8")){class
Min_DB{var$extension="oci8",$_link,$_result,$server_info,$affected_rows,$errno,$error;var$_current_db;function
_error($ac,$m){if(ini_bool("html_errors"))$m=html_entity_decode(strip_tags($m));$m=preg_replace('~^[^:]*: ~','',$m);$this->error=$m;}function
connect($M,$V,$E){$this->_link=@oci_new_connect($V,$E,$M,"AL32UTF8");if($this->_link){$this->server_info=oci_server_version($this->_link);return
true;}$m=oci_error();$this->error=$m["message"];return
false;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($i){$this->_current_db=$i;return
true;}function
query($F,$Ag=false){$G=oci_parse($this->_link,$F);$this->error="";if(!$G){$m=oci_error($this->_link);$this->errno=$m["code"];$this->error=$m["message"];return
false;}set_error_handler(array($this,'_error'));$H=@oci_execute($G);restore_error_handler();if($H){if(oci_num_fields($G))return
new
Min_Result($G);$this->affected_rows=oci_num_rows($G);oci_free_statement($G);}return$H;}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$n=1){$G=$this->query($F);if(!is_object($G)||!oci_fetch($G->_result))return
false;return
oci_result($G->_result,$n);}}class
Min_Result{var$_result,$_offset=1,$num_rows;function
__construct($G){$this->_result=$G;}function
_convert($I){foreach((array)$I
as$y=>$X){if(is_a($X,'OCI-Lob'))$I[$y]=$X->load();}return$I;}function
fetch_assoc(){return$this->_convert(oci_fetch_assoc($this->_result));}function
fetch_row(){return$this->_convert(oci_fetch_row($this->_result));}function
fetch_field(){$e=$this->_offset++;$H=new
stdClass;$H->name=oci_field_name($this->_result,$e);$H->orgname=$H->name;$H->type=oci_field_type($this->_result,$e);$H->charsetnr=(preg_match("~raw|blob|bfile~",$H->type)?63:0);return$H;}function
__destruct(){oci_free_statement($this->_result);}}}elseif(extension_loaded("pdo_oci")){class
Min_DB
extends
Min_PDO{var$extension="PDO_OCI";var$_current_db;function
connect($M,$V,$E){$this->dsn("oci:dbname=//$M;charset=AL32UTF8",$V,$E);return
true;}function
select_db($i){$this->_current_db=$i;return
true;}}}class
Min_Driver
extends
Min_SQL{function
begin(){return
true;}function
insertUpdate($Q,$J,$Me){global$g;foreach($J
as$N){$Hg=array();$Z=array();foreach($N
as$y=>$X){$Hg[]="$y = $X";if(isset($Me[idf_unescape($y)]))$Z[]="$y = $X";}if(!(($Z&&queries("UPDATE ".table($Q)." SET ".implode(", ",$Hg)." WHERE ".implode(" AND ",$Z))&&$g->affected_rows)||queries("INSERT INTO ".table($Q)." (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).")")))return
false;}return
true;}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b;$g=new
Min_DB;$vb=$b->credentials();if($g->connect($vb[0],$vb[1],$vb[2]))return$g;return$g->error;}function
get_databases(){return
get_vals("SELECT tablespace_name FROM user_tablespaces ORDER BY 1");}function
limit($F,$Z,$z,$ee=0,$L=" "){return($ee?" * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $F$Z) t WHERE rownum <= ".($z+$ee).") WHERE rnum > $ee":($z!==null?" * FROM (SELECT $F$Z) WHERE rownum <= ".($z+$ee):" $F$Z"));}function
limit1($Q,$F,$Z,$L="\n"){return" $F$Z";}function
db_collation($k,$ab){global$g;return$g->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT USER FROM DUAL");}function
get_current_db(){global$g;$k=$g->_current_db?$g->_current_db:DB;unset($g->_current_db);return$k;}function
where_owner($Le,$we="owner"){if(!$_GET["ns"])return'';return"$Le$we = sys_context('USERENV', 'CURRENT_SCHEMA')";}function
views_table($f){$we=where_owner('');return"(SELECT $f FROM all_views WHERE ".($we?$we:"rownum < 0").")";}function
tables_list(){$Rg=views_table("view_name");$we=where_owner(" AND ");return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."$we
UNION SELECT view_name, 'view' FROM $Rg
ORDER BY 1");}function
count_tables($j){global$g;$H=array();foreach($j
as$k)$H[$k]=$g->result("SELECT COUNT(*) FROM all_tables WHERE tablespace_name = ".q($k));return$H;}function
table_status($B=""){$H=array();$rf=q($B);$k=get_current_db();$Rg=views_table("view_name");$we=where_owner(" AND ");foreach(get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = '.q($k).$we.($B!=""?" AND table_name = $rf":"")."
UNION SELECT view_name, 'view', 0, 0 FROM $Rg".($B!=""?" WHERE view_name = $rf":"")."
ORDER BY 1")as$I){if($B!="")return$I;$H[$I["Name"]]=$I;}return$H;}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){return
true;}function
fields($Q){$H=array();$we=where_owner(" AND ");foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($Q)."$we ORDER BY column_id")as$I){$T=$I["DATA_TYPE"];$_d="$I[DATA_PRECISION],$I[DATA_SCALE]";if($_d==",")$_d=$I["CHAR_COL_DECL_LENGTH"];$H[$I["COLUMN_NAME"]]=array("field"=>$I["COLUMN_NAME"],"full_type"=>$T.($_d?"($_d)":""),"type"=>strtolower($T),"length"=>$_d,"default"=>$I["DATA_DEFAULT"],"null"=>($I["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);}return$H;}function
indexes($Q,$h=null){$H=array();$we=where_owner(" AND ","aic.table_owner");foreach(get_rows("SELECT aic.*, ac.constraint_type, atc.data_default
FROM all_ind_columns aic
LEFT JOIN all_constraints ac ON aic.index_name = ac.constraint_name AND aic.table_name = ac.table_name AND aic.index_owner = ac.owner
LEFT JOIN all_tab_cols atc ON aic.column_name = atc.column_name AND aic.table_name = atc.table_name AND aic.index_owner = atc.owner
WHERE aic.table_name = ".q($Q)."$we
ORDER BY ac.constraint_type, aic.column_position",$h)as$I){$Zc=$I["INDEX_NAME"];$db=$I["DATA_DEFAULT"];$db=($db?trim($db,'"'):$I["COLUMN_NAME"]);$H[$Zc]["type"]=($I["CONSTRAINT_TYPE"]=="P"?"PRIMARY":($I["CONSTRAINT_TYPE"]=="U"?"UNIQUE":"INDEX"));$H[$Zc]["columns"][]=$db;$H[$Zc]["lengths"][]=($I["CHAR_LENGTH"]&&$I["CHAR_LENGTH"]!=$I["COLUMN_LENGTH"]?$I["CHAR_LENGTH"]:null);$H[$Zc]["descs"][]=($I["DESCEND"]&&$I["DESCEND"]=="DESC"?'1':null);}return$H;}function
view($B){$Rg=views_table("view_name, text");$J=get_rows('SELECT text "select" FROM '.$Rg.' WHERE view_name = '.q($B));return
reset($J);}function
collations(){return
array();}function
information_schema($k){return
false;}function
error(){global$g;return
h($g->error);}function
explain($g,$F){$g->query("EXPLAIN PLAN FOR $F");return$g->query("SELECT * FROM plan_table");}function
found_rows($R,$Z){}function
auto_increment(){return"";}function
alter_table($Q,$B,$o,$zc,$fb,$Xb,$d,$Da,$Be){$c=$Mb=array();$se=($Q?fields($Q):array());foreach($o
as$n){$X=$n[1];if($X&&$n[0]!=""&&idf_escape($n[0])!=$X[0])queries("ALTER TABLE ".table($Q)." RENAME COLUMN ".idf_escape($n[0])." TO $X[0]");$re=$se[$n[0]];if($X&&$re){$ge=process_field($re,$re);if($X[2]==$ge[2])$X[2]="";}if($X)$c[]=($Q!=""?($n[0]!=""?"MODIFY (":"ADD ("):"  ").implode($X).($Q!=""?")":"");else$Mb[]=idf_escape($n[0]);}if($Q=="")return
queries("CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)");return(!$c||queries("ALTER TABLE ".table($Q)."\n".implode("\n",$c)))&&(!$Mb||queries("ALTER TABLE ".table($Q)." DROP (".implode(", ",$Mb).")"))&&($Q==$B||queries("ALTER TABLE ".table($Q)." RENAME TO ".table($B)));}function
alter_indexes($Q,$c){$Mb=array();$Ue=array();foreach($c
as$X){if($X[0]!="INDEX"){$X[2]=preg_replace('~ DESC$~','',$X[2]);$tb=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");array_unshift($Ue,"ALTER TABLE ".table($Q).$tb);}elseif($X[2]=="DROP")$Mb[]=idf_escape($X[1]);else$Ue[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q)." (".implode(", ",$X[2]).")";}if($Mb)array_unshift($Ue,"DROP INDEX ".implode(", ",$Mb));foreach($Ue
as$F){if(!queries($F))return
false;}return
true;}function
foreign_keys($Q){$H=array();$F="SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = ".q($Q);foreach(get_rows($F)as$I)$H[$I['NAME']]=array("db"=>$I['DEST_DB'],"table"=>$I['DEST_TABLE'],"source"=>array($I['SRC_COLUMN']),"target"=>array($I['DEST_COLUMN']),"on_delete"=>$I['ON_DELETE'],"on_update"=>null,);return$H;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Sg){return
apply_queries("DROP VIEW",$Sg);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
last_id(){return
0;}function
schemas(){$H=get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX')) ORDER BY 1");return($H?$H:get_vals("SELECT DISTINCT owner FROM all_tables WHERE tablespace_name = ".q(DB)." ORDER BY 1"));}function
get_schema(){global$g;return$g->result("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");}function
set_schema($qf,$h=null){global$g;if(!$h)$h=$g;return$h->query("ALTER SESSION SET CURRENT_SCHEMA = ".idf_escape($qf));}function
show_variables(){return
get_key_vals('SELECT name, display_value FROM v$parameter');}function
process_list(){return
get_rows('SELECT sess.process AS "process", sess.username AS "user", sess.schemaname AS "schema", sess.status AS "status", sess.wait_class AS "wait_class", sess.seconds_in_wait AS "seconds_in_wait", sql.sql_text AS "sql_text", sess.machine AS "machine", sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');}function
show_status(){$J=get_rows('SELECT * FROM v$instance');return
reset($J);}function
convert_field($n){}function
unconvert_field($n,$H){return$H;}function
support($nc){return
preg_match('~^(columns|database|drop_col|indexes|descidx|processlist|scheme|sql|status|table|variables|view)$~',$nc);}function
driver_config(){$U=array();$Qf=array();foreach(array('Numbers'=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),'Date and time'=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),'Strings'=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),'Binary'=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),)as$y=>$X){$U+=$X;$Qf[$y]=array_keys($X);}return
array('possible_drivers'=>array("OCI8","PDO_OCI"),'jush'=>"oracle",'types'=>$U,'structured_types'=>$Qf,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL"),'functions'=>array("length","lower","round","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("date"=>"current_date","timestamp"=>"current_timestamp",),array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",)),);}}$Lb["mssql"]="MS SQL (beta)";if(isset($_GET["mssql"])){define("DRIVER","mssql");if(extension_loaded("sqlsrv")){class
Min_DB{var$extension="sqlsrv",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_get_error(){$this->error="";foreach(sqlsrv_errors()as$m){$this->errno=$m["code"];$this->error.="$m[message]\n";}$this->error=rtrim($this->error);}function
connect($M,$V,$E){global$b;$k=$b->database();$lb=array("UID"=>$V,"PWD"=>$E,"CharacterSet"=>"UTF-8");if($k!="")$lb["Database"]=$k;$this->_link=@sqlsrv_connect(preg_replace('~:~',',',$M),$lb);if($this->_link){$gd=sqlsrv_server_info($this->_link);$this->server_info=$gd['SQLServerVersion'];}else$this->_get_error();return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($i){return$this->query("USE ".idf_escape($i));}function
query($F,$Ag=false){$G=sqlsrv_query($this->_link,$F);$this->error="";if(!$G){$this->_get_error();return
false;}return$this->store_result($G);}function
multi_query($F){$this->_result=sqlsrv_query($this->_link,$F);$this->error="";if(!$this->_result){$this->_get_error();return
false;}return
true;}function
store_result($G=null){if(!$G)$G=$this->_result;if(!$G)return
false;if(sqlsrv_field_metadata($G))return
new
Min_Result($G);$this->affected_rows=sqlsrv_rows_affected($G);return
true;}function
next_result(){return$this->_result?sqlsrv_next_result($this->_result):null;}function
result($F,$n=0){$G=$this->query($F);if(!is_object($G))return
false;$I=$G->fetch_row();return$I[$n];}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($G){$this->_result=$G;}function
_convert($I){foreach((array)$I
as$y=>$X){if(is_a($X,'DateTime'))$I[$y]=$X->format("Y-m-d H:i:s");}return$I;}function
fetch_assoc(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_ASSOC));}function
fetch_row(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_NUMERIC));}function
fetch_field(){if(!$this->_fields)$this->_fields=sqlsrv_field_metadata($this->_result);$n=$this->_fields[$this->_offset++];$H=new
stdClass;$H->name=$n["Name"];$H->orgname=$n["Name"];$H->type=($n["Type"]==1?254:0);return$H;}function
seek($ee){for($s=0;$s<$ee;$s++)sqlsrv_fetch($this->_result);}function
__destruct(){sqlsrv_free_stmt($this->_result);}}}elseif(extension_loaded("mssql")){class
Min_DB{var$extension="MSSQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($M,$V,$E){$this->_link=@mssql_connect($M,$V,$E);if($this->_link){$G=$this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");if($G){$I=$G->fetch_row();$this->server_info=$this->result("sp_server_info 2",2)." [$I[0]] $I[1]";}}else$this->error=mssql_get_last_message();return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($i){return
mssql_select_db($i);}function
query($F,$Ag=false){$G=@mssql_query($F,$this->_link);$this->error="";if(!$G){$this->error=mssql_get_last_message();return
false;}if($G===true){$this->affected_rows=mssql_rows_affected($this->_link);return
true;}return
new
Min_Result($G);}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
mssql_next_result($this->_result->_result);}function
result($F,$n=0){$G=$this->query($F);if(!is_object($G))return
false;return
mssql_result($G->_result,0,$n);}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($G){$this->_result=$G;$this->num_rows=mssql_num_rows($G);}function
fetch_assoc(){return
mssql_fetch_assoc($this->_result);}function
fetch_row(){return
mssql_fetch_row($this->_result);}function
num_rows(){return
mssql_num_rows($this->_result);}function
fetch_field(){$H=mssql_fetch_field($this->_result);$H->orgtable=$H->table;$H->orgname=$H->name;return$H;}function
seek($ee){mssql_data_seek($this->_result,$ee);}function
__destruct(){mssql_free_result($this->_result);}}}elseif(extension_loaded("pdo_dblib")){class
Min_DB
extends
Min_PDO{var$extension="PDO_DBLIB";function
connect($M,$V,$E){$this->dsn("dblib:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$M)),$V,$E);return
true;}function
select_db($i){return$this->query("USE ".idf_escape($i));}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$J,$Me){foreach($J
as$N){$Hg=array();$Z=array();foreach($N
as$y=>$X){$Hg[]="$y = $X";if(isset($Me[idf_unescape($y)]))$Z[]="$y = $X";}if(!queries("MERGE ".table($Q)." USING (VALUES(".implode(", ",$N).")) AS source (c".implode(", c",range(1,count($N))).") ON ".implode(" AND ",$Z)." WHEN MATCHED THEN UPDATE SET ".implode(", ",$Hg)." WHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).");"))return
false;}return
true;}function
begin(){return
queries("BEGIN TRANSACTION");}}function
idf_escape($u){return"[".str_replace("]","]]",$u)."]";}function
table($u){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($u);}function
connect(){global$b;$g=new
Min_DB;$vb=$b->credentials();if($g->connect($vb[0],$vb[1],$vb[2]))return$g;return$g->error;}function
get_databases(){return
get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");}function
limit($F,$Z,$z,$ee=0,$L=" "){return($z!==null?" TOP (".($z+$ee).")":"")." $F$Z";}function
limit1($Q,$F,$Z,$L="\n"){return
limit($F,$Z,1,0,$L);}function
db_collation($k,$ab){global$g;return$g->result("SELECT collation_name FROM sys.databases WHERE name = ".q($k));}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($j){global$g;$H=array();foreach($j
as$k){$g->select_db($k);$H[$k]=$g->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$H;}function
table_status($B=""){$H=array();foreach(get_rows("SELECT ao.name AS Name, ao.type_desc AS Engine, (SELECT value FROM fn_listextendedproperty(default, 'SCHEMA', schema_name(schema_id), 'TABLE', ao.name, null, null)) AS Comment FROM sys.all_objects AS ao WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ".($B!=""?"AND name = ".q($B):"ORDER BY name"))as$I){if($B!="")return$I;$H[$I["Name"]]=$I;}return$H;}function
is_view($R){return$R["Engine"]=="VIEW";}function
fk_support($R){return
true;}function
fields($Q){$gb=get_key_vals("SELECT objname, cast(value as varchar(max)) FROM fn_listextendedproperty('MS_DESCRIPTION', 'schema', ".q(get_schema()).", 'table', ".q($Q).", 'column', NULL)");$H=array();foreach(get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, CAST(d.definition as text) [default]
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.parent_column_id
WHERE o.schema_id = SCHEMA_ID(".q(get_schema()).") AND o.type IN ('S', 'U', 'V') AND o.name = ".q($Q))as$I){$T=$I["type"];$_d=(preg_match("~char|binary~",$T)?$I["max_length"]:($T=="decimal"?"$I[precision],$I[scale]":""));$H[$I["name"]]=array("field"=>$I["name"],"full_type"=>$T.($_d?"($_d)":""),"type"=>$T,"length"=>$_d,"default"=>$I["default"],"null"=>$I["is_nullable"],"auto_increment"=>$I["is_identity"],"collation"=>$I["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"primary"=>$I["is_identity"],"comment"=>$gb[$I["name"]],);}return$H;}function
indexes($Q,$h=null){$H=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($Q),$h)as$I){$B=$I["name"];$H[$B]["type"]=($I["is_primary_key"]?"PRIMARY":($I["is_unique"]?"UNIQUE":"INDEX"));$H[$B]["lengths"]=array();$H[$B]["columns"][$I["key_ordinal"]]=$I["column_name"];$H[$B]["descs"][$I["key_ordinal"]]=($I["is_descending_key"]?'1':null);}return$H;}function
view($B){global$g;return
array("select"=>preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU','',$g->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($B))));}function
collations(){$H=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$d)$H[preg_replace('~_.*~','',$d)][]=$d;return$H;}function
information_schema($k){return
false;}function
error(){global$g;return
nl_br(h(preg_replace('~^(\[[^]]*])+~m','',$g->error)));}function
create_database($k,$d){return
queries("CREATE DATABASE ".idf_escape($k).(preg_match('~^[a-z0-9_]+$~i',$d)?" COLLATE $d":""));}function
drop_databases($j){return
queries("DROP DATABASE ".implode(", ",array_map('idf_escape',$j)));}function
rename_database($B,$d){if(preg_match('~^[a-z0-9_]+$~i',$d))queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $d");queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($B));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".number($_POST["Auto_increment"]).",1)":"")." PRIMARY KEY";}function
alter_table($Q,$B,$o,$zc,$fb,$Xb,$d,$Da,$Be){$c=array();$gb=array();foreach($o
as$n){$e=idf_escape($n[0]);$X=$n[1];if(!$X)$c["DROP"][]=" COLUMN $e";else{$X[1]=preg_replace("~( COLLATE )'(\\w+)'~",'\1\2',$X[1]);$gb[$n[0]]=$X[5];unset($X[5]);if($n[0]=="")$c["ADD"][]="\n  ".implode("",$X).($Q==""?substr($zc[$X[0]],16+strlen($X[0])):"");else{unset($X[6]);if($e!=$X[0])queries("EXEC sp_rename ".q(table($Q).".$e").", ".q(idf_unescape($X[0])).", 'COLUMN'");$c["ALTER COLUMN ".implode("",$X)][]="";}}}if($Q=="")return
queries("CREATE TABLE ".table($B)." (".implode(",",(array)$c["ADD"])."\n)");if($Q!=$B)queries("EXEC sp_rename ".q(table($Q)).", ".q($B));if($zc)$c[""]=$zc;foreach($c
as$y=>$X){if(!queries("ALTER TABLE ".idf_escape($B)." $y".implode(",",$X)))return
false;}foreach($gb
as$y=>$X){$fb=substr($X,9);queries("EXEC sp_dropextendedproperty @name = N'MS_Description', @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table', @level1name = ".q($B).", @level2type = N'Column', @level2name = ".q($y));queries("EXEC sp_addextendedproperty @name = N'MS_Description', @value = ".$fb.", @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table', @level1name = ".q($B).", @level2type = N'Column', @level2name = ".q($y));}return
true;}function
alter_indexes($Q,$c){$v=array();$Mb=array();foreach($c
as$X){if($X[2]=="DROP"){if($X[0]=="PRIMARY")$Mb[]=idf_escape($X[1]);else$v[]=idf_escape($X[1])." ON ".table($Q);}elseif(!queries(($X[0]!="PRIMARY"?"CREATE $X[0] ".($X[0]!="INDEX"?"INDEX ":"").idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q):"ALTER TABLE ".table($Q)." ADD PRIMARY KEY")." (".implode(", ",$X[2]).")"))return
false;}return(!$v||queries("DROP INDEX ".implode(", ",$v)))&&(!$Mb||queries("ALTER TABLE ".table($Q)." DROP ".implode(", ",$Mb)));}function
last_id(){global$g;return$g->result("SELECT SCOPE_IDENTITY()");}function
explain($g,$F){$g->query("SET SHOWPLAN_ALL ON");$H=$g->query($F);$g->query("SET SHOWPLAN_ALL OFF");return$H;}function
found_rows($R,$Z){}function
foreign_keys($Q){$H=array();foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($Q))as$I){$q=&$H[$I["FK_NAME"]];$q["db"]=$I["PKTABLE_QUALIFIER"];$q["table"]=$I["PKTABLE_NAME"];$q["source"][]=$I["FKCOLUMN_NAME"];$q["target"][]=$I["PKCOLUMN_NAME"];}return$H;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Sg){return
queries("DROP VIEW ".implode(", ",array_map('table',$Sg)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$Sg,$ag){return
apply_queries("ALTER SCHEMA ".idf_escape($ag)." TRANSFER",array_merge($S,$Sg));}function
trigger($B){if($B=="")return
array();$J=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($B));$H=reset($J);if($H)$H["Statement"]=preg_replace('~^.+\s+AS\s+~isU','',$H["text"]);return$H;}function
triggers($Q){$H=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($Q))as$I)$H[$I["name"]]=array($I["Timing"],$I["Event"]);return$H;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){global$g;if($_GET["ns"]!="")return$_GET["ns"];return$g->result("SELECT SCHEMA_NAME()");}function
set_schema($pf){return
true;}function
use_sql($i){return"USE ".idf_escape($i);}function
show_variables(){return
array();}function
show_status(){return
array();}function
convert_field($n){}function
unconvert_field($n,$H){return$H;}function
support($nc){return
preg_match('~^(comment|columns|database|drop_col|indexes|descidx|scheme|sql|table|trigger|view|view_trigger)$~',$nc);}function
driver_config(){$U=array();$Qf=array();foreach(array('Numbers'=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),'Date and time'=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),'Strings'=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),'Binary'=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),)as$y=>$X){$U+=$X;$Qf[$y]=array_keys($X);}return
array('possible_drivers'=>array("SQLSRV","MSSQL","PDO_DBLIB"),'jush'=>"mssql",'types'=>$U,'structured_types'=>$Qf,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL"),'functions'=>array("len","lower","round","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("date|time"=>"getdate",),array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",)),);}}$Lb["mongo"]="MongoDB (alpha)";if(isset($_GET["mongo"])){define("DRIVER","mongo");if(class_exists('MongoDB')){class
Min_DB{var$extension="Mongo",$server_info=MongoClient::VERSION,$error,$last_id,$_link,$_db;function
connect($Ig,$C){try{$this->_link=new
MongoClient($Ig,$C);if($C["password"]!=""){$C["password"]="";try{new
MongoClient($Ig,$C);$this->error='Database does not support password.';}catch(Exception$Pb){}}}catch(Exception$Pb){$this->error=$Pb->getMessage();}}function
query($F){return
false;}function
select_db($i){try{$this->_db=$this->_link->selectDB($i);return
true;}catch(Exception$dc){$this->error=$dc->getMessage();return
false;}}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($G){foreach($G
as$pd){$I=array();foreach($pd
as$y=>$X){if(is_a($X,'MongoBinData'))$this->_charset[$y]=63;$I[$y]=(is_a($X,'MongoId')?"ObjectId(\"$X\")":(is_a($X,'MongoDate')?gmdate("Y-m-d H:i:s",$X->sec)." GMT":(is_a($X,'MongoBinData')?$X->bin:(is_a($X,'MongoRegex')?"$X":(is_object($X)?get_class($X):$X)))));}$this->_rows[]=$I;foreach($I
as$y=>$X){if(!isset($this->_rows[0][$y]))$this->_rows[0][$y]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$I=current($this->_rows);if(!$I)return$I;$H=array();foreach($this->_rows[0]as$y=>$X)$H[$y]=$I[$y];next($this->_rows);return$H;}function
fetch_row(){$H=$this->fetch_assoc();if(!$H)return$H;return
array_values($H);}function
fetch_field(){$sd=array_keys($this->_rows[0]);$B=$sd[$this->_offset++];return(object)array('name'=>$B,'charsetnr'=>$this->_charset[$B],);}}class
Min_Driver
extends
Min_SQL{public$Me="_id";function
select($Q,$K,$Z,$Hc,$pe=array(),$z=1,$D=0,$Oe=false){$K=($K==array("*")?array():array_fill_keys($K,true));$Gf=array();foreach($pe
as$X){$X=preg_replace('~ DESC$~','',$X,1,$rb);$Gf[$X]=($rb?-1:1);}return
new
Min_Result($this->_conn->_db->selectCollection($Q)->find(array(),$K)->sort($Gf)->limit($z!=""?+$z:0)->skip($D*$z));}function
insert($Q,$N){try{$H=$this->_conn->_db->selectCollection($Q)->insert($N);$this->_conn->errno=$H['code'];$this->_conn->error=$H['err'];$this->_conn->last_id=$N['_id'];return!$H['err'];}catch(Exception$dc){$this->_conn->error=$dc->getMessage();return
false;}}}function
get_databases($xc){global$g;$H=array();$Ab=$g->_link->listDBs();foreach($Ab['databases']as$k)$H[]=$k['name'];return$H;}function
count_tables($j){global$g;$H=array();foreach($j
as$k)$H[$k]=count($g->_link->selectDB($k)->getCollectionNames(true));return$H;}function
tables_list(){global$g;return
array_fill_keys($g->_db->getCollectionNames(true),'table');}function
drop_databases($j){global$g;foreach($j
as$k){$hf=$g->_link->selectDB($k)->drop();if(!$hf['ok'])return
false;}return
true;}function
indexes($Q,$h=null){global$g;$H=array();foreach($g->_db->selectCollection($Q)->getIndexInfo()as$v){$Gb=array();foreach($v["key"]as$e=>$T)$Gb[]=($T==-1?'1':null);$H[$v["name"]]=array("type"=>($v["name"]=="_id_"?"PRIMARY":($v["unique"]?"UNIQUE":"INDEX")),"columns"=>array_keys($v["key"]),"lengths"=>array(),"descs"=>$Gb,);}return$H;}function
fields($Q){return
fields_from_edit();}function
found_rows($R,$Z){global$g;return$g->_db->selectCollection($_GET["select"])->count($Z);}$me=array("=");}elseif(class_exists('MongoDB\Driver\Manager')){class
Min_DB{var$extension="MongoDB",$server_info=MONGODB_VERSION,$affected_rows,$error,$last_id;var$_link;var$_db,$_db_name;function
connect($Ig,$C){$Wa='MongoDB\Driver\Manager';$this->_link=new$Wa($Ig,$C);$this->executeCommand('admin',array('ping'=>1));}function
executeCommand($k,$eb){$Wa='MongoDB\Driver\Command';try{return$this->_link->executeCommand($k,new$Wa($eb));}catch(Exception$Pb){$this->error=$Pb->getMessage();return
array();}}function
executeBulkWrite($Yd,$Pa,$sb){try{$kf=$this->_link->executeBulkWrite($Yd,$Pa);$this->affected_rows=$kf->$sb();return
true;}catch(Exception$Pb){$this->error=$Pb->getMessage();return
false;}}function
query($F){return
false;}function
select_db($i){$this->_db_name=$i;return
true;}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($G){foreach($G
as$pd){$I=array();foreach($pd
as$y=>$X){if(is_a($X,'MongoDB\BSON\Binary'))$this->_charset[$y]=63;$I[$y]=(is_a($X,'MongoDB\BSON\ObjectID')?'MongoDB\BSON\ObjectID("'."$X\")":(is_a($X,'MongoDB\BSON\UTCDatetime')?$X->toDateTime()->format('Y-m-d H:i:s'):(is_a($X,'MongoDB\BSON\Binary')?$X->getData():(is_a($X,'MongoDB\BSON\Regex')?"$X":(is_object($X)||is_array($X)?json_encode($X,256):$X)))));}$this->_rows[]=$I;foreach($I
as$y=>$X){if(!isset($this->_rows[0][$y]))$this->_rows[0][$y]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$I=current($this->_rows);if(!$I)return$I;$H=array();foreach($this->_rows[0]as$y=>$X)$H[$y]=$I[$y];next($this->_rows);return$H;}function
fetch_row(){$H=$this->fetch_assoc();if(!$H)return$H;return
array_values($H);}function
fetch_field(){$sd=array_keys($this->_rows[0]);$B=$sd[$this->_offset++];return(object)array('name'=>$B,'charsetnr'=>$this->_charset[$B],);}}class
Min_Driver
extends
Min_SQL{public$Me="_id";function
select($Q,$K,$Z,$Hc,$pe=array(),$z=1,$D=0,$Oe=false){global$g;$K=($K==array("*")?array():array_fill_keys($K,1));if(count($K)&&!isset($K['_id']))$K['_id']=0;$Z=where_to_query($Z);$Gf=array();foreach($pe
as$X){$X=preg_replace('~ DESC$~','',$X,1,$rb);$Gf[$X]=($rb?-1:1);}if(isset($_GET['limit'])&&is_numeric($_GET['limit'])&&$_GET['limit']>0)$z=$_GET['limit'];$z=min(200,max(1,(int)$z));$Df=$D*$z;$Wa='MongoDB\Driver\Query';try{return
new
Min_Result($g->_link->executeQuery("$g->_db_name.$Q",new$Wa($Z,array('projection'=>$K,'limit'=>$z,'skip'=>$Df,'sort'=>$Gf))));}catch(Exception$Pb){$g->error=$Pb->getMessage();return
false;}}function
update($Q,$N,$Ve,$z=0,$L="\n"){global$g;$k=$g->_db_name;$Z=sql_query_where_parser($Ve);$Wa='MongoDB\Driver\BulkWrite';$Pa=new$Wa(array());if(isset($N['_id']))unset($N['_id']);$df=array();foreach($N
as$y=>$Y){if($Y=='NULL'){$df[$y]=1;unset($N[$y]);}}$Hg=array('$set'=>$N);if(count($df))$Hg['$unset']=$df;$Pa->update($Z,$Hg,array('upsert'=>false));return$g->executeBulkWrite("$k.$Q",$Pa,'getModifiedCount');}function
delete($Q,$Ve,$z=0){global$g;$k=$g->_db_name;$Z=sql_query_where_parser($Ve);$Wa='MongoDB\Driver\BulkWrite';$Pa=new$Wa(array());$Pa->delete($Z,array('limit'=>$z));return$g->executeBulkWrite("$k.$Q",$Pa,'getDeletedCount');}function
insert($Q,$N){global$g;$k=$g->_db_name;$Wa='MongoDB\Driver\BulkWrite';$Pa=new$Wa(array());if($N['_id']=='')unset($N['_id']);$Pa->insert($N);return$g->executeBulkWrite("$k.$Q",$Pa,'getInsertedCount');}}function
get_databases($xc){global$g;$H=array();foreach($g->executeCommand('admin',array('listDatabases'=>1))as$Ab){foreach($Ab->databases
as$k)$H[]=$k->name;}return$H;}function
count_tables($j){$H=array();return$H;}function
tables_list(){global$g;$bb=array();foreach($g->executeCommand($g->_db_name,array('listCollections'=>1))as$G)$bb[$G->name]='table';return$bb;}function
drop_databases($j){return
false;}function
indexes($Q,$h=null){global$g;$H=array();foreach($g->executeCommand($g->_db_name,array('listIndexes'=>$Q))as$v){$Gb=array();$f=array();foreach(get_object_vars($v->key)as$e=>$T){$Gb[]=($T==-1?'1':null);$f[]=$e;}$H[$v->name]=array("type"=>($v->name=="_id_"?"PRIMARY":(isset($v->unique)?"UNIQUE":"INDEX")),"columns"=>$f,"lengths"=>array(),"descs"=>$Gb,);}return$H;}function
fields($Q){global$l;$o=fields_from_edit();if(!$o){$G=$l->select($Q,array("*"),null,null,array(),10);if($G){while($I=$G->fetch_assoc()){foreach($I
as$y=>$X){$I[$y]=null;$o[$y]=array("field"=>$y,"type"=>"string","null"=>($y!=$l->primary),"auto_increment"=>($y==$l->primary),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,),);}}}}return$o;}function
found_rows($R,$Z){global$g;$Z=where_to_query($Z);$og=$g->executeCommand($g->_db_name,array('count'=>$R['Name'],'query'=>$Z))->toArray();return$og[0]->n;}function
sql_query_where_parser($Ve){$Ve=preg_replace('~^\sWHERE \(?\(?(.+?)\)?\)?$~','\1',$Ve);$ah=explode(' AND ',$Ve);$bh=explode(') OR (',$Ve);$Z=array();foreach($ah
as$Yg)$Z[]=trim($Yg);if(count($bh)==1)$bh=array();elseif(count($bh)>1)$Z=array();return
where_to_query($Z,$bh);}function
where_to_query($Wg=array(),$Xg=array()){global$b;$zb=array();foreach(array('and'=>$Wg,'or'=>$Xg)as$T=>$Z){if(is_array($Z)){foreach($Z
as$gc){list($Za,$ke,$X)=explode(" ",$gc,3);if($Za=="_id"&&preg_match('~^(MongoDB\\\\BSON\\\\ObjectID)\("(.+)"\)$~',$X,$A)){list(,$Wa,$X)=$A;$X=new$Wa($X);}if(!in_array($ke,$b->operators))continue;if(preg_match('~^\(f\)(.+)~',$ke,$A)){$X=(float)$X;$ke=$A[1];}elseif(preg_match('~^\(date\)(.+)~',$ke,$A)){$_b=new
DateTime($X);$Wa='MongoDB\BSON\UTCDatetime';$X=new$Wa($_b->getTimestamp()*1000);$ke=$A[1];}switch($ke){case'=':$ke='$eq';break;case'!=':$ke='$ne';break;case'>':$ke='$gt';break;case'<':$ke='$lt';break;case'>=':$ke='$gte';break;case'<=':$ke='$lte';break;case'regex':$ke='$regex';break;default:continue
2;}if($T=='and')$zb['$and'][]=array($Za=>array($ke=>$X));elseif($T=='or')$zb['$or'][]=array($Za=>array($ke=>$X));}}}return$zb;}$me=array("=","!=",">","<",">=","<=","regex","(f)=","(f)!=","(f)>","(f)<","(f)>=","(f)<=","(date)=","(date)!=","(date)>","(date)<","(date)>=","(date)<=",);}function
table($u){return$u;}function
idf_escape($u){return$u;}function
table_status($B="",$mc=false){$H=array();foreach(tables_list()as$Q=>$T){$H[$Q]=array("Name"=>$Q);if($B==$Q)return$H[$Q];}return$H;}function
create_database($k,$d){return
true;}function
last_id(){global$g;return$g->last_id;}function
error(){global$g;return
h($g->error);}function
collations(){return
array();}function
logged_user(){global$b;$vb=$b->credentials();return$vb[1];}function
connect(){global$b;$g=new
Min_DB;list($M,$V,$E)=$b->credentials();$C=array();if($V.$E!=""){$C["username"]=$V;$C["password"]=$E;}$k=$b->database();if($k!="")$C["db"]=$k;if(($Ca=getenv("MONGO_AUTH_SOURCE")))$C["authSource"]=$Ca;$g->connect("mongodb://$M",$C);if($g->error)return$g->error;return$g;}function
alter_indexes($Q,$c){global$g;foreach($c
as$X){list($T,$B,$N)=$X;if($N=="DROP")$H=$g->_db->command(array("deleteIndexes"=>$Q,"index"=>$B));else{$f=array();foreach($N
as$e){$e=preg_replace('~ DESC$~','',$e,1,$rb);$f[$e]=($rb?-1:1);}$H=$g->_db->selectCollection($Q)->ensureIndex($f,array("unique"=>($T=="UNIQUE"),"name"=>$B,));}if($H['errmsg']){$g->error=$H['errmsg'];return
false;}}return
true;}function
support($nc){return
preg_match("~database|indexes|descidx~",$nc);}function
db_collation($k,$ab){}function
information_schema(){}function
is_view($R){}function
convert_field($n){}function
unconvert_field($n,$H){return$H;}function
foreign_keys($Q){return
array();}function
fk_support($R){}function
engines(){return
array();}function
alter_table($Q,$B,$o,$zc,$fb,$Xb,$d,$Da,$Be){global$g;if($Q==""){$g->_db->createCollection($B);return
true;}}function
drop_tables($S){global$g;foreach($S
as$Q){$hf=$g->_db->selectCollection($Q)->drop();if(!$hf['ok'])return
false;}return
true;}function
truncate_tables($S){global$g;foreach($S
as$Q){$hf=$g->_db->selectCollection($Q)->remove();if(!$hf['ok'])return
false;}return
true;}function
driver_config(){global$me;return
array('possible_drivers'=>array("mongo","mongodb"),'jush'=>"mongo",'operators'=>$me,'functions'=>array(),'grouping'=>array(),'edit_functions'=>array(array("json")),);}}$Lb["elastic"]="Elasticsearch (beta)";if(isset($_GET["elastic"])){define("DRIVER","elastic");if(function_exists('json_decode')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="JSON",$server_info,$errno,$error,$_url,$_db;function
rootQuery($De,$pb=array(),$Sd='GET'){@ini_set('track_errors',1);$qc=@file_get_contents("$this->_url/".ltrim($De,'/'),false,stream_context_create(array('http'=>array('method'=>$Sd,'content'=>$pb===null?$pb:json_encode($pb),'header'=>'Content-Type: application/json','ignore_errors'=>1,))));if(!$qc){$this->error=$php_errormsg;return$qc;}if(!preg_match('~^HTTP/[0-9.]+ 2~i',$http_response_header[0])){$this->error='Invalid credentials.'." $http_response_header[0]";return
false;}$H=json_decode($qc,true);if($H===null){$this->errno=json_last_error();if(function_exists('json_last_error_msg'))$this->error=json_last_error_msg();else{$nb=get_defined_constants(true);foreach($nb['json']as$B=>$Y){if($Y==$this->errno&&preg_match('~^JSON_ERROR_~',$B)){$this->error=$B;break;}}}}return$H;}function
query($De,$pb=array(),$Sd='GET'){return$this->rootQuery(($this->_db!=""?"$this->_db/":"/").ltrim($De,'/'),$pb,$Sd);}function
connect($M,$V,$E){preg_match('~^(https?://)?(.*)~',$M,$A);$this->_url=($A[1]?$A[1]:"http://")."$V:$E@$A[2]";$H=$this->query('');if($H)$this->server_info=$H['version']['number'];return(bool)$H;}function
select_db($i){$this->_db=$i;return
true;}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows;function
__construct($J){$this->num_rows=count($J);$this->_rows=$J;reset($this->_rows);}function
fetch_assoc(){$H=current($this->_rows);next($this->_rows);return$H;}function
fetch_row(){return
array_values($this->fetch_assoc());}}}class
Min_Driver
extends
Min_SQL{function
select($Q,$K,$Z,$Hc,$pe=array(),$z=1,$D=0,$Oe=false){global$b;$zb=array();$F="$Q/_search";if($K!=array("*"))$zb["fields"]=$K;if($pe){$Gf=array();foreach($pe
as$Za){$Za=preg_replace('~ DESC$~','',$Za,1,$rb);$Gf[]=($rb?array($Za=>"desc"):$Za);}$zb["sort"]=$Gf;}if($z){$zb["size"]=+$z;if($D)$zb["from"]=($D*$z);}foreach($Z
as$X){list($Za,$ke,$X)=explode(" ",$X,3);if($Za=="_id")$zb["query"]["ids"]["values"][]=$X;elseif($Za.$X!=""){$cg=array("term"=>array(($Za!=""?$Za:"_all")=>$X));if($ke=="=")$zb["query"]["filtered"]["filter"]["and"][]=$cg;else$zb["query"]["filtered"]["query"]["bool"]["must"][]=$cg;}}if($zb["query"]&&!$zb["query"]["filtered"]["query"]&&!$zb["query"]["ids"])$zb["query"]["filtered"]["query"]=array("match_all"=>array());$Nf=microtime(true);$rf=$this->_conn->query($F,$zb);if($Oe)echo$b->selectQuery("$F: ".json_encode($zb),$Nf,!$rf);if(!$rf)return
false;$H=array();foreach($rf['hits']['hits']as$Tc){$I=array();if($K==array("*"))$I["_id"]=$Tc["_id"];$o=$Tc['_source'];if($K!=array("*")){$o=array();foreach($K
as$y)$o[$y]=$Tc['fields'][$y];}foreach($o
as$y=>$X){if($zb["fields"])$X=$X[0];$I[$y]=(is_array($X)?json_encode($X):$X);}$H[]=$I;}return
new
Min_Result($H);}function
update($T,$Ze,$Ve,$z=0,$L="\n"){$Ce=preg_split('~ *= *~',$Ve);if(count($Ce)==2){$t=trim($Ce[1]);$F="$T/$t";return$this->_conn->query($F,$Ze,'POST');}return
false;}function
insert($T,$Ze){$t="";$F="$T/$t";$hf=$this->_conn->query($F,$Ze,'POST');$this->_conn->last_id=$hf['_id'];return$hf['created'];}function
delete($T,$Ve,$z=0){$Xc=array();if(is_array($_GET["where"])&&$_GET["where"]["_id"])$Xc[]=$_GET["where"]["_id"];if(is_array($_POST['check'])){foreach($_POST['check']as$Ra){$Ce=preg_split('~ *= *~',$Ra);if(count($Ce)==2)$Xc[]=trim($Ce[1]);}}$this->_conn->affected_rows=0;foreach($Xc
as$t){$F="{$T}/{$t}";$hf=$this->_conn->query($F,'{}','DELETE');if(is_array($hf)&&$hf['found']==true)$this->_conn->affected_rows++;}return$this->_conn->affected_rows;}}function
connect(){global$b;$g=new
Min_DB;list($M,$V,$E)=$b->credentials();if($E!=""&&$g->connect($M,$V,""))return'Database does not support password.';if($g->connect($M,$V,$E))return$g;return$g->error;}function
support($nc){return
preg_match("~database|table|columns~",$nc);}function
logged_user(){global$b;$vb=$b->credentials();return$vb[1];}function
get_databases(){global$g;$H=$g->rootQuery('_aliases');if($H){$H=array_keys($H);sort($H,SORT_STRING);}return$H;}function
collations(){return
array();}function
db_collation($k,$ab){}function
engines(){return
array();}function
count_tables($j){global$g;$H=array();$G=$g->query('_stats');if($G&&$G['indices']){$dd=$G['indices'];foreach($dd
as$cd=>$Of){$bd=$Of['total']['indexing'];$H[$cd]=$bd['index_total'];}}return$H;}function
tables_list(){global$g;if(min_version(6))return
array('_doc'=>'table');$H=$g->query('_mapping');if($H)$H=array_fill_keys(array_keys($H[$g->_db]["mappings"]),'table');return$H;}function
table_status($B="",$mc=false){global$g;$rf=$g->query("_search",array("size"=>0,"aggregations"=>array("count_by_type"=>array("terms"=>array("field"=>"_type")))),"POST");$H=array();if($rf){$S=$rf["aggregations"]["count_by_type"]["buckets"];foreach($S
as$Q){$H[$Q["key"]]=array("Name"=>$Q["key"],"Engine"=>"table","Rows"=>$Q["doc_count"],);if($B!=""&&$B==$Q["key"])return$H[$B];}}return$H;}function
error(){global$g;return
h($g->error);}function
information_schema(){}function
is_view($R){}function
indexes($Q,$h=null){return
array(array("type"=>"PRIMARY","columns"=>array("_id")),);}function
fields($Q){global$g;$Gd=array();if(min_version(6)){$G=$g->query("_mapping");if($G)$Gd=$G[$g->_db]['mappings']['properties'];}else{$G=$g->query("$Q/_mapping");if($G){$Gd=$G[$Q]['properties'];if(!$Gd)$Gd=$G[$g->_db]['mappings'][$Q]['properties'];}}$H=array();if($Gd){foreach($Gd
as$B=>$n){$H[$B]=array("field"=>$B,"full_type"=>$n["type"],"type"=>$n["type"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);if($n["properties"]){unset($H[$B]["privileges"]["insert"]);unset($H[$B]["privileges"]["update"]);}}}return$H;}function
foreign_keys($Q){return
array();}function
table($u){return$u;}function
idf_escape($u){return$u;}function
convert_field($n){}function
unconvert_field($n,$H){return$H;}function
fk_support($R){}function
found_rows($R,$Z){return
null;}function
create_database($k){global$g;return$g->rootQuery(urlencode($k),null,'PUT');}function
drop_databases($j){global$g;return$g->rootQuery(urlencode(implode(',',$j)),array(),'DELETE');}function
alter_table($Q,$B,$o,$zc,$fb,$Xb,$d,$Da,$Be){global$g;$Re=array();foreach($o
as$kc){$oc=trim($kc[1][0]);$pc=trim($kc[1][1]?$kc[1][1]:"text");$Re[$oc]=array('type'=>$pc);}if(!empty($Re))$Re=array('properties'=>$Re);return$g->query("_mapping/{$B}",$Re,'PUT');}function
drop_tables($S){global$g;$H=true;foreach($S
as$Q)$H=$H&&$g->query(urlencode($Q),array(),'DELETE');return$H;}function
last_id(){global$g;return$g->last_id;}function
driver_config(){$U=array();$Qf=array();foreach(array('Numbers'=>array("long"=>3,"integer"=>5,"short"=>8,"byte"=>10,"double"=>20,"float"=>66,"half_float"=>12,"scaled_float"=>21),'Date and time'=>array("date"=>10),'Strings'=>array("string"=>65535,"text"=>65535),'Binary'=>array("binary"=>255),)as$y=>$X){$U+=$X;$Qf[$y]=array_keys($X);}return
array('possible_drivers'=>array("json + allow_url_fopen"),'jush'=>"elastic",'operators'=>array("=","query"),'functions'=>array(),'grouping'=>array(),'edit_functions'=>array(array("json")),'types'=>$U,'structured_types'=>$Qf,);}}class
Adminer{var$operators=array("<=",">=");var$_values=array();function
name(){return"<a href='https://www.adminer.org/editor/'".target_blank()." id='h1'>".'Editor'."</a>";}function
credentials(){return
array(SERVER,$_GET["username"],get_password());}function
connectSsl(){}function
permanentLogin($tb=false){return
password_file($tb);}function
bruteForceKey(){return$_SERVER["REMOTE_ADDR"];}function
serverName($M){}function
database(){global$g;if($g){$j=$this->databases(false);return(!$j?$g->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1)"):$j[(information_schema($j[0])?1:0)]);}}function
schemas(){return
schemas();}function
databases($xc=true){return
get_databases($xc);}function
queryTimeout(){return
5;}function
headers(){}function
csp(){return
csp();}function
head(){return
true;}function
css(){$H=array();$p="adminer.css";if(file_exists($p))$H[]=$p;return$H;}function
loginForm(){echo"<table cellspacing='0' class='layout'>\n",$this->loginFormField('username','<tr><th>'.'Username'.'<td>','<input type="hidden" name="auth[driver]" value="server"><input name="auth[username]" id="username" value="'.h($_GET["username"]).'" autocomplete="username" autocapitalize="off">'.script("focus(qs('#username'));")),$this->loginFormField('password','<tr><th>'.'Password'.'<td>','<input type="password" name="auth[password]" autocomplete="current-password">'."\n"),"</table>\n","<p><input type='submit' value='".'Login'."'>\n",checkbox("auth[permanent]",1,$_COOKIE["adminer_permanent"],'Permanent login')."\n";}function
loginFormField($B,$Rc,$Y){return$Rc.$Y;}function
login($Ed,$E){return
true;}function
tableName($Wf){return
h($Wf["Comment"]!=""?$Wf["Comment"]:$Wf["Name"]);}function
fieldName($n,$pe=0){return
h(preg_replace('~\s+\[.*\]$~','',($n["comment"]!=""?$n["comment"]:$n["field"])));}function
selectLinks($Wf,$N=""){$a=$Wf["Name"];if($N!==null)echo'<p class="tabs"><a href="'.h(ME.'edit='.urlencode($a).$N).'">'.'New item'."</a>\n";}function
foreignKeys($Q){return
foreign_keys($Q);}function
backwardKeys($Q,$Vf){$H=array();foreach(get_rows("SELECT TABLE_NAME, CONSTRAINT_NAME, COLUMN_NAME, REFERENCED_COLUMN_NAME
FROM information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = ".q($this->database())."
AND REFERENCED_TABLE_SCHEMA = ".q($this->database())."
AND REFERENCED_TABLE_NAME = ".q($Q)."
ORDER BY ORDINAL_POSITION",null,"")as$I)$H[$I["TABLE_NAME"]]["keys"][$I["CONSTRAINT_NAME"]][$I["COLUMN_NAME"]]=$I["REFERENCED_COLUMN_NAME"];foreach($H
as$y=>$X){$B=$this->tableName(table_status($y,true));if($B!=""){$rf=preg_quote($Vf);$L="(:|\\s*-)?\\s+";$H[$y]["name"]=(preg_match("(^$rf$L(.+)|^(.+?)$L$rf\$)iu",$B,$A)?$A[2].$A[3]:$B);}else
unset($H[$y]);}return$H;}function
backwardKeysPrint($Ha,$I){foreach($Ha
as$Q=>$Ga){foreach($Ga["keys"]as$cb){$_=ME.'select='.urlencode($Q);$s=0;foreach($cb
as$e=>$X)$_.=where_link($s++,$e,$I[$X]);echo"<a href='".h($_)."'>".h($Ga["name"])."</a>";$_=ME.'edit='.urlencode($Q);foreach($cb
as$e=>$X)$_.="&set".urlencode("[".bracket_escape($e)."]")."=".urlencode($I[$X]);echo"<a href='".h($_)."' title='".'New item'."'>+</a> ";}}}function
selectQuery($F,$Nf,$lc=false){return"<!--\n".str_replace("--","--><!-- ",$F)."\n(".format_time($Nf).")\n-->\n";}function
rowDescription($Q){foreach(fields($Q)as$n){if(preg_match("~varchar|character varying~",$n["type"]))return
idf_escape($n["field"]);}return"";}function
rowDescriptions($J,$Ac){$H=$J;foreach($J[0]as$y=>$X){if(list($Q,$t,$B)=$this->_foreignColumn($Ac,$y)){$Xc=array();foreach($J
as$I)$Xc[$I[$y]]=q($I[$y]);$Fb=$this->_values[$Q];if(!$Fb)$Fb=get_key_vals("SELECT $t, $B FROM ".table($Q)." WHERE $t IN (".implode(", ",$Xc).")");foreach($J
as$Wd=>$I){if(isset($I[$y]))$H[$Wd][$y]=(string)$Fb[$I[$y]];}}}return$H;}function
selectLink($X,$n){}function
selectVal($X,$_,$n,$te){$H=$X;$_=h($_);if(preg_match('~blob|bytea~',$n["type"])&&!is_utf8($X)){$H=lang(array('%d byte','%d bytes'),strlen($te));if(preg_match("~^(GIF|\xFF\xD8\xFF|\x89PNG\x0D\x0A\x1A\x0A)~",$te))$H="<img src='$_' alt='$H'>";}if(like_bool($n)&&$H!="")$H=(preg_match('~^(1|t|true|y|yes|on)$~i',$X)?'yes':'no');if($_)$H="<a href='$_'".(is_url($_)?target_blank():"").">$H</a>";if(!$_&&!like_bool($n)&&preg_match(number_type(),$n["type"]))$H="<div class='number'>$H</div>";elseif(preg_match('~date~',$n["type"]))$H="<div class='datetime'>$H</div>";return$H;}function
editVal($X,$n){if(preg_match('~date|timestamp~',$n["type"])&&$X!==null)return
preg_replace('~^(\d{2}(\d+))-(0?(\d+))-(0?(\d+))~','$1-$3-$5',$X);return$X;}function
selectColumnsPrint($K,$f){}function
selectSearchPrint($Z,$f,$w){$Z=(array)$_GET["where"];echo'<fieldset id="fieldset-search"><legend>'.'Search'."</legend><div>\n";$sd=array();foreach($Z
as$y=>$X)$sd[$X["col"]]=$y;$s=0;$o=fields($_GET["select"]);foreach($f
as$B=>$Eb){$n=$o[$B];if(preg_match("~enum~",$n["type"])||like_bool($n)){$y=$sd[$B];$s--;echo"<div>".h($Eb)."<input type='hidden' name='where[$s][col]' value='".h($B)."'>:",(like_bool($n)?" <select name='where[$s][val]'>".optionlist(array(""=>"",'no','yes'),$Z[$y]["val"],true)."</select>":enum_input("checkbox"," name='where[$s][val][]'",$n,(array)$Z[$y]["val"],($n["null"]?0:null))),"</div>\n";unset($f[$B]);}elseif(is_array($C=$this->_foreignKeyOptions($_GET["select"],$B))){if($o[$B]["null"])$C[0]='('.'empty'.')';$y=$sd[$B];$s--;echo"<div>".h($Eb)."<input type='hidden' name='where[$s][col]' value='".h($B)."'><input type='hidden' name='where[$s][op]' value='='>: <select name='where[$s][val]'>".optionlist($C,$Z[$y]["val"],true)."</select></div>\n";unset($f[$B]);}}$s=0;foreach($Z
as$X){if(($X["col"]==""||$f[$X["col"]])&&"$X[col]$X[val]"!=""){echo"<div><select name='where[$s][col]'><option value=''>(".'anywhere'.")".optionlist($f,$X["col"],true)."</select>",html_select("where[$s][op]",array(-1=>"")+$this->operators,$X["op"]),"<input type='search' name='where[$s][val]' value='".h($X["val"])."'>".script("mixin(qsl('input'), {onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});","")."</div>\n";$s++;}}echo"<div><select name='where[$s][col]'><option value=''>(".'anywhere'.")".optionlist($f,null,true)."</select>",script("qsl('select').onchange = selectAddRow;",""),html_select("where[$s][op]",array(-1=>"")+$this->operators),"<input type='search' name='where[$s][val]'></div>",script("mixin(qsl('input'), {onchange: function () { this.parentNode.firstChild.onchange(); }, onsearch: selectSearchSearch});"),"</div></fieldset>\n";}function
selectOrderPrint($pe,$f,$w){$qe=array();foreach($w
as$y=>$v){$pe=array();foreach($v["columns"]as$X)$pe[]=$f[$X];if(count(array_filter($pe,'strlen'))>1&&$y!="PRIMARY")$qe[$y]=implode(", ",$pe);}if($qe){echo'<fieldset><legend>'.'Sort'."</legend><div>","<select name='index_order'>".optionlist(array(""=>"")+$qe,($_GET["order"][0]!=""?"":$_GET["index_order"]),true)."</select>","</div></fieldset>\n";}if($_GET["order"])echo"<div style='display: none;'>".hidden_fields(array("order"=>array(1=>reset($_GET["order"])),"desc"=>($_GET["desc"]?array(1=>1):array()),))."</div>\n";}function
selectLimitPrint($z){echo"<fieldset><legend>".'Limit'."</legend><div>";echo
html_select("limit",array("","50","100"),$z),"</div></fieldset>\n";}function
selectLengthPrint($eg){}function
selectActionPrint($w){echo"<fieldset><legend>".'Action'."</legend><div>","<input type='submit' value='".'Select'."'>","</div></fieldset>\n";}function
selectCommandPrint(){return
true;}function
selectImportPrint(){return
true;}function
selectEmailPrint($Ub,$f){if($Ub){print_fieldset("email",'E-mail',$_POST["email_append"]);echo"<div>",script("qsl('div').onkeydown = partialArg(bodyKeydown, 'email');"),"<p>".'From'.": <input name='email_from' value='".h($_POST?$_POST["email_from"]:$_COOKIE["adminer_email"])."'>\n",'Subject'.": <input name='email_subject' value='".h($_POST["email_subject"])."'>\n","<p><textarea name='email_message' rows='15' cols='75'>".h($_POST["email_message"].($_POST["email_append"]?'{$'."$_POST[email_addition]}":""))."</textarea>\n","<p>".script("qsl('p').onkeydown = partialArg(bodyKeydown, 'email_append');","").html_select("email_addition",$f,$_POST["email_addition"])."<input type='submit' name='email_append' value='".'Insert'."'>\n";echo"<p>".'Attachments'.": <input type='file' name='email_files[]'>".script("qsl('input').onchange = emailFileChange;"),"<p>".(count($Ub)==1?'<input type="hidden" name="email_field" value="'.h(key($Ub)).'">':html_select("email_field",$Ub)),"<input type='submit' name='email' value='".'Send'."'>".confirm(),"</div>\n","</div></fieldset>\n";}}function
selectColumnsProcess($f,$w){return
array(array(),array());}function
selectSearchProcess($o,$w){global$l;$H=array();foreach((array)$_GET["where"]as$y=>$Z){$Za=$Z["col"];$ke=$Z["op"];$X=$Z["val"];if(($y<0?"":$Za).$X!=""){$hb=array();foreach(($Za!=""?array($Za=>$o[$Za]):$o)as$B=>$n){if($Za!=""||is_numeric($X)||!preg_match(number_type(),$n["type"])){$B=idf_escape($B);if($Za!=""&&$n["type"]=="enum")$hb[]=(in_array(0,$X)?"$B IS NULL OR ":"")."$B IN (".implode(", ",array_map('intval',$X)).")";else{$fg=preg_match('~char|text|enum|set~',$n["type"]);$Y=$this->processInput($n,(!$ke&&$fg&&preg_match('~^[^%]+$~',$X)?"%$X%":$X));$hb[]=$l->convertSearch($B,$X,$n).($Y=="NULL"?" IS".($ke==">="?" NOT":"")." $Y":(in_array($ke,$this->operators)||$ke=="="?" $ke $Y":($fg?" LIKE $Y":" IN (".str_replace(",","', '",$Y).")")));if($y<0&&$X=="0")$hb[]="$B IS NULL";}}}$H[]=($hb?"(".implode(" OR ",$hb).")":"1 = 0");}}return$H;}function
selectOrderProcess($o,$w){$ad=$_GET["index_order"];if($ad!="")unset($_GET["order"][1]);if($_GET["order"])return
array(idf_escape(reset($_GET["order"])).($_GET["desc"]?" DESC":""));foreach(($ad!=""?array($w[$ad]):$w)as$v){if($ad!=""||$v["type"]=="INDEX"){$Mc=array_filter($v["descs"]);$Eb=false;foreach($v["columns"]as$X){if(preg_match('~date|timestamp~',$o[$X]["type"])){$Eb=true;break;}}$H=array();foreach($v["columns"]as$y=>$X)$H[]=idf_escape($X).(($Mc?$v["descs"][$y]:$Eb)?" DESC":"");return$H;}}return
array();}function
selectLimitProcess(){return(isset($_GET["limit"])?$_GET["limit"]:"50");}function
selectLengthProcess(){return"100";}function
selectEmailProcess($Z,$Ac){if($_POST["email_append"])return
true;if($_POST["email"]){$vf=0;if($_POST["all"]||$_POST["check"]){$n=idf_escape($_POST["email_field"]);$Sf=$_POST["email_subject"];$Qd=$_POST["email_message"];preg_match_all('~\{\$([a-z0-9_]+)\}~i',"$Sf.$Qd",$Kd);$J=get_rows("SELECT DISTINCT $n".($Kd[1]?", ".implode(", ",array_map('idf_escape',array_unique($Kd[1]))):"")." FROM ".table($_GET["select"])." WHERE $n IS NOT NULL AND $n != ''".($Z?" AND ".implode(" AND ",$Z):"").($_POST["all"]?"":" AND ((".implode(") OR (",array_map('where_check',(array)$_POST["check"]))."))"));$o=fields($_GET["select"]);foreach($this->rowDescriptions($J,$Ac)as$I){$ff=array('{\\'=>'{');foreach($Kd[1]as$X)$ff['{$'."$X}"]=$this->editVal($I[$X],$o[$X]);$Tb=$I[$_POST["email_field"]];if(is_mail($Tb)&&send_mail($Tb,strtr($Sf,$ff),strtr($Qd,$ff),$_POST["email_from"],$_FILES["email_files"]))$vf++;}}cookie("adminer_email",$_POST["email_from"]);redirect(remove_from_uri(),lang(array('%d e-mail has been sent.','%d e-mails have been sent.'),$vf));}return
false;}function
selectQueryBuild($K,$Z,$Hc,$pe,$z,$D){return"";}function
messageQuery($F,$gg,$lc=false){return" <span class='time'>".@date("H:i:s")."</span><!--\n".str_replace("--","--><!-- ",$F)."\n".($gg?"($gg)\n":"")."-->";}function
editRowPrint($Q,$o,$I,$Hg){}function
editFunctions($n){$H=array();if($n["null"]&&preg_match('~blob~',$n["type"]))$H["NULL"]='empty';$H[""]=($n["null"]||$n["auto_increment"]||like_bool($n)?"":"*");if(preg_match('~date|time~',$n["type"]))$H["now"]='now';if(preg_match('~_(md5|sha1)$~i',$n["field"],$A))$H[]=strtolower($A[1]);return$H;}function
editInput($Q,$n,$Aa,$Y){if($n["type"]=="enum")return(isset($_GET["select"])?"<label><input type='radio'$Aa value='-1' checked><i>".'original'."</i></label> ":"").enum_input("radio",$Aa,$n,($Y||isset($_GET["select"])?$Y:0),($n["null"]?"":null));$C=$this->_foreignKeyOptions($Q,$n["field"],$Y);if($C!==null)return(is_array($C)?"<select$Aa>".optionlist($C,$Y,true)."</select>":"<input value='".h($Y)."'$Aa class='hidden'>"."<input value='".h($C)."' class='jsonly'>"."<div></div>".script("qsl('input').oninput = partial(whisper, '".ME."script=complete&source=".urlencode($Q)."&field=".urlencode($n["field"])."&value=');
qsl('div').onclick = whisperClick;",""));if(like_bool($n))return'<input type="checkbox" value="1"'.(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?' checked':'')."$Aa>";$Sc="";if(preg_match('~time~',$n["type"]))$Sc='HH:MM:SS';if(preg_match('~date|timestamp~',$n["type"]))$Sc='[yyyy]-mm-dd'.($Sc?" [$Sc]":"");if($Sc)return"<input value='".h($Y)."'$Aa> ($Sc)";if(preg_match('~_(md5|sha1)$~i',$n["field"]))return"<input type='password' value='".h($Y)."'$Aa>";return'';}function
editHint($Q,$n,$Y){return(preg_match('~\s+(\[.*\])$~',($n["comment"]!=""?$n["comment"]:$n["field"]),$A)?h(" $A[1]"):'');}function
processInput($n,$Y,$r=""){if($r=="now")return"$r()";$H=$Y;if(preg_match('~date|timestamp~',$n["type"])&&preg_match('(^'.str_replace('\$1','(?P<p1>\d*)',preg_replace('~(\\\\\\$([2-6]))~','(?P<p\2>\d{1,2})',preg_quote('$1-$3-$5'))).'(.*))',$Y,$A))$H=($A["p1"]!=""?$A["p1"]:($A["p2"]!=""?($A["p2"]<70?20:19).$A["p2"]:gmdate("Y")))."-$A[p3]$A[p4]-$A[p5]$A[p6]".end($A);$H=($n["type"]=="bit"&&preg_match('~^[0-9]+$~',$Y)?$H:q($H));if($Y==""&&like_bool($n))$H="'0'";elseif($Y==""&&($n["null"]||!preg_match('~char|text~',$n["type"])))$H="NULL";elseif(preg_match('~^(md5|sha1)$~',$r))$H="$r($H)";return
unconvert_field($n,$H);}function
dumpOutput(){return
array();}function
dumpFormat(){return
array('csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpDatabase($k){}function
dumpTable($Q,$Rf,$od=0){echo"\xef\xbb\xbf";}function
dumpData($Q,$Rf,$F){global$g;$G=$g->query($F,1);if($G){while($I=$G->fetch_assoc()){if($Rf=="table"){dump_csv(array_keys($I));$Rf="INSERT";}dump_csv($I);}}}function
dumpFilename($Wc){return
friendly_url($Wc);}function
dumpHeaders($Wc,$Ud=false){$hc="csv";header("Content-Type: text/csv; charset=utf-8");return$hc;}function
importServerPath(){}function
homepage(){return
true;}function
navigation($Td){global$ca;echo'<h1>
',$this->name(),' <span class="version">',$ca,'</span>
<a href="https://www.adminer.org/editor/#download"',target_blank(),' id="version">',(version_compare($ca,$_COOKIE["adminer_version"])<0?h($_COOKIE["adminer_version"]):""),'</a>
</h1>
';if($Td=="auth"){$tc=true;foreach((array)$_SESSION["pwds"]as$Pg=>$_f){foreach($_f[""]as$V=>$E){if($E!==null){if($tc){echo"<ul id='logins'>",script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");$tc=false;}echo"<li><a href='".h(auth_url($Pg,"",$V))."'>".($V!=""?h($V):"<i>".'empty'."</i>")."</a>\n";}}}}else{$this->databasesPrint($Td);if($Td!="db"&&$Td!="ns"){$R=table_status('',true);if(!$R)echo"<p class='message'>".'No tables.'."\n";else$this->tablesPrint($R);}}}function
databasesPrint($Td){}function
tablesPrint($S){echo"<ul id='tables'>",script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");foreach($S
as$I){echo'<li>';$B=$this->tableName($I);if(isset($I["Engine"])&&$B!="")echo"<a href='".h(ME).'select='.urlencode($I["Name"])."'".bold($_GET["select"]==$I["Name"]||$_GET["edit"]==$I["Name"],"select")." title='".'Select data'."'>$B</a>\n";}echo"</ul>\n";}function
_foreignColumn($Ac,$e){foreach((array)$Ac[$e]as$_c){if(count($_c["source"])==1){$B=$this->rowDescription($_c["table"]);if($B!=""){$t=idf_escape($_c["target"][0]);return
array($_c["table"],$t,$B);}}}}function
_foreignKeyOptions($Q,$e,$Y=null){global$g;if(list($ag,$t,$B)=$this->_foreignColumn(column_foreign_keys($Q),$e)){$H=&$this->_values[$ag];if($H===null){$R=table_status($ag);$H=($R["Rows"]>1000?"":array(""=>"")+get_key_vals("SELECT $t, $B FROM ".table($ag)." ORDER BY 2"));}if(!$H&&$Y!==null)return$g->result("SELECT $B FROM ".table($ag)." WHERE $t = ".q($Y));return$H;}}}$b=(function_exists('adminer_object')?adminer_object():new
Adminer);$Lb=array("server"=>"MySQL")+$Lb;if(!defined("DRIVER")){define("DRIVER","server");if(extension_loaded("mysqli")){class
Min_DB
extends
MySQLi{var$extension="MySQLi";function
__construct(){parent::init();}function
connect($M="",$V="",$E="",$i=null,$Ie=null,$Ff=null){global$b;mysqli_report(MYSQLI_REPORT_OFF);list($Uc,$Ie)=explode(":",$M,2);$Mf=$b->connectSsl();if($Mf)$this->ssl_set($Mf['key'],$Mf['cert'],$Mf['ca'],'','');$H=@$this->real_connect(($M!=""?$Uc:ini_get("mysqli.default_host")),($M.$V!=""?$V:ini_get("mysqli.default_user")),($M.$V.$E!=""?$E:ini_get("mysqli.default_pw")),$i,(is_numeric($Ie)?$Ie:ini_get("mysqli.default_port")),(!is_numeric($Ie)?$Ie:$Ff),($Mf?64:0));$this->options(MYSQLI_OPT_LOCAL_INFILE,false);return$H;}function
set_charset($Qa){if(parent::set_charset($Qa))return
true;parent::set_charset('utf8');return$this->query("SET NAMES $Qa");}function
result($F,$n=0){$G=$this->query($F);if(!$G)return
false;$I=$G->fetch_array();return$I[$n];}function
quote($P){return"'".$this->escape_string($P)."'";}}}elseif(extension_loaded("mysql")&&!((ini_bool("sql.safe_mode")||ini_bool("mysql.allow_local_infile"))&&extension_loaded("pdo_mysql"))){class
Min_DB{var$extension="MySQL",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($M,$V,$E){if(ini_bool("mysql.allow_local_infile")){$this->error=sprintf('Disable %s or enable %s or %s extensions.',"'mysql.allow_local_infile'","MySQLi","PDO_MySQL");return
false;}$this->_link=@mysql_connect(($M!=""?$M:ini_get("mysql.default_host")),("$M$V"!=""?$V:ini_get("mysql.default_user")),("$M$V$E"!=""?$E:ini_get("mysql.default_password")),true,131072);if($this->_link)$this->server_info=mysql_get_server_info($this->_link);else$this->error=mysql_error();return(bool)$this->_link;}function
set_charset($Qa){if(function_exists('mysql_set_charset')){if(mysql_set_charset($Qa,$this->_link))return
true;mysql_set_charset('utf8',$this->_link);}return$this->query("SET NAMES $Qa");}function
quote($P){return"'".mysql_real_escape_string($P,$this->_link)."'";}function
select_db($i){return
mysql_select_db($i,$this->_link);}function
query($F,$Ag=false){$G=@($Ag?mysql_unbuffered_query($F,$this->_link):mysql_query($F,$this->_link));$this->error="";if(!$G){$this->errno=mysql_errno($this->_link);$this->error=mysql_error($this->_link);return
false;}if($G===true){$this->affected_rows=mysql_affected_rows($this->_link);$this->info=mysql_info($this->_link);return
true;}return
new
Min_Result($G);}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$n=0){$G=$this->query($F);if(!$G||!$G->num_rows)return
false;return
mysql_result($G->_result,0,$n);}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($G){$this->_result=$G;$this->num_rows=mysql_num_rows($G);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$H=mysql_fetch_field($this->_result,$this->_offset++);$H->orgtable=$H->table;$H->orgname=$H->name;$H->charsetnr=($H->blob?63:0);return$H;}function
__destruct(){mysql_free_result($this->_result);}}}elseif(extension_loaded("pdo_mysql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_MySQL";function
connect($M,$V,$E){global$b;$C=array(PDO::MYSQL_ATTR_LOCAL_INFILE=>false);$Mf=$b->connectSsl();if($Mf){if(!empty($Mf['key']))$C[PDO::MYSQL_ATTR_SSL_KEY]=$Mf['key'];if(!empty($Mf['cert']))$C[PDO::MYSQL_ATTR_SSL_CERT]=$Mf['cert'];if(!empty($Mf['ca']))$C[PDO::MYSQL_ATTR_SSL_CA]=$Mf['ca'];}$this->dsn("mysql:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$M)),$V,$E,$C);return
true;}function
set_charset($Qa){$this->query("SET NAMES $Qa");}function
select_db($i){return$this->query("USE ".idf_escape($i));}function
query($F,$Ag=false){$this->pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,!$Ag);return
parent::query($F,$Ag);}}}class
Min_Driver
extends
Min_SQL{function
insert($Q,$N){return($N?parent::insert($Q,$N):queries("INSERT INTO ".table($Q)." ()\nVALUES ()"));}function
insertUpdate($Q,$J,$Me){$f=array_keys(reset($J));$Le="INSERT INTO ".table($Q)." (".implode(", ",$f).") VALUES\n";$Og=array();foreach($f
as$y)$Og[$y]="$y = VALUES($y)";$Tf="\nON DUPLICATE KEY UPDATE ".implode(", ",$Og);$Og=array();$_d=0;foreach($J
as$N){$Y="(".implode(", ",$N).")";if($Og&&(strlen($Le)+$_d+strlen($Y)+strlen($Tf)>1e6)){if(!queries($Le.implode(",\n",$Og).$Tf))return
false;$Og=array();$_d=0;}$Og[]=$Y;$_d+=strlen($Y)+2;}return
queries($Le.implode(",\n",$Og).$Tf);}function
slowQuery($F,$hg){if(min_version('5.7.8','10.1.2')){if(preg_match('~MariaDB~',$this->_conn->server_info))return"SET STATEMENT max_statement_time=$hg FOR $F";elseif(preg_match('~^(SELECT\b)(.+)~is',$F,$A))return"$A[1] /*+ MAX_EXECUTION_TIME(".($hg*1000).") */ $A[2]";}}function
convertSearch($u,$X,$n){return(preg_match('~char|text|enum|set~',$n["type"])&&!preg_match("~^utf8~",$n["collation"])&&preg_match('~[\x80-\xFF]~',$X['val'])?"CONVERT($u USING ".charset($this->_conn).")":$u);}function
warnings(){$G=$this->_conn->query("SHOW WARNINGS");if($G&&$G->num_rows){ob_start();select($G);return
ob_get_clean();}}function
tableHelp($B){$Hd=preg_match('~MariaDB~',$this->_conn->server_info);if(information_schema(DB))return
strtolower(($Hd?"information-schema-$B-table/":str_replace("_","-",$B)."-table.html"));if(DB=="mysql")return($Hd?"mysql$B-table/":"system-database.html");}}function
idf_escape($u){return"`".str_replace("`","``",$u)."`";}function
table($u){return
idf_escape($u);}function
connect(){global$b,$U,$Qf;$g=new
Min_DB;$vb=$b->credentials();if($g->connect($vb[0],$vb[1],$vb[2])){$g->set_charset(charset($g));$g->query("SET sql_quote_show_create = 1, autocommit = 1");if(min_version('5.7.8',10.2,$g)){$Qf['Strings'][]="json";$U["json"]=4294967295;}return$g;}$H=$g->error;if(function_exists('iconv')&&!is_utf8($H)&&strlen($of=iconv("windows-1250","utf-8",$H))>strlen($H))$H=$of;return$H;}function
get_databases($xc){$H=get_session("dbs");if($H===null){$F=(min_version(5)?"SELECT SCHEMA_NAME FROM information_schema.SCHEMATA ORDER BY SCHEMA_NAME":"SHOW DATABASES");$H=($xc?slow_query($F):get_vals($F));restart_session();set_session("dbs",$H);stop_session();}return$H;}function
limit($F,$Z,$z,$ee=0,$L=" "){return" $F$Z".($z!==null?$L."LIMIT $z".($ee?" OFFSET $ee":""):"");}function
limit1($Q,$F,$Z,$L="\n"){return
limit($F,$Z,1,0,$L);}function
db_collation($k,$ab){global$g;$H=null;$tb=$g->result("SHOW CREATE DATABASE ".idf_escape($k),1);if(preg_match('~ COLLATE ([^ ]+)~',$tb,$A))$H=$A[1];elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$tb,$A))$H=$ab[$A[1]][-1];return$H;}function
engines(){$H=array();foreach(get_rows("SHOW ENGINES")as$I){if(preg_match("~YES|DEFAULT~",$I["Support"]))$H[]=$I["Engine"];}return$H;}function
logged_user(){global$g;return$g->result("SELECT USER()");}function
tables_list(){return
get_key_vals(min_version(5)?"SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME":"SHOW TABLES");}function
count_tables($j){$H=array();foreach($j
as$k)$H[$k]=count(get_vals("SHOW TABLES IN ".idf_escape($k)));return$H;}function
table_status($B="",$mc=false){$H=array();foreach(get_rows($mc&&min_version(5)?"SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ".($B!=""?"AND TABLE_NAME = ".q($B):"ORDER BY Name"):"SHOW TABLE STATUS".($B!=""?" LIKE ".q(addcslashes($B,"%_\\")):""))as$I){if($I["Engine"]=="InnoDB")$I["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\1',$I["Comment"]);if(!isset($I["Engine"]))$I["Comment"]="";if($B!="")return$I;$H[$I["Name"]]=$I;}return$H;}function
is_view($R){return$R["Engine"]===null;}function
fk_support($R){return
preg_match('~InnoDB|IBMDB2I~i',$R["Engine"])||(preg_match('~NDB~i',$R["Engine"])&&min_version(5.6));}function
fields($Q){$H=array();foreach(get_rows("SHOW FULL COLUMNS FROM ".table($Q))as$I){preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~',$I["Type"],$A);$H[$I["Field"]]=array("field"=>$I["Field"],"full_type"=>$I["Type"],"type"=>$A[1],"length"=>$A[2],"unsigned"=>ltrim($A[3].$A[4]),"default"=>($I["Default"]!=""||preg_match("~char|set~",$A[1])?(preg_match('~text~',$A[1])?stripslashes(preg_replace("~^'(.*)'\$~",'\1',$I["Default"])):$I["Default"]):null),"null"=>($I["Null"]=="YES"),"auto_increment"=>($I["Extra"]=="auto_increment"),"on_update"=>(preg_match('~^on update (.+)~i',$I["Extra"],$A)?$A[1]:""),"collation"=>$I["Collation"],"privileges"=>array_flip(preg_split('~, *~',$I["Privileges"])),"comment"=>$I["Comment"],"primary"=>($I["Key"]=="PRI"),"generated"=>preg_match('~^(VIRTUAL|PERSISTENT|STORED)~',$I["Extra"]),);}return$H;}function
indexes($Q,$h=null){$H=array();foreach(get_rows("SHOW INDEX FROM ".table($Q),$h)as$I){$B=$I["Key_name"];$H[$B]["type"]=($B=="PRIMARY"?"PRIMARY":($I["Index_type"]=="FULLTEXT"?"FULLTEXT":($I["Non_unique"]?($I["Index_type"]=="SPATIAL"?"SPATIAL":"INDEX"):"UNIQUE")));$H[$B]["columns"][]=$I["Column_name"];$H[$B]["lengths"][]=($I["Index_type"]=="SPATIAL"?null:$I["Sub_part"]);$H[$B]["descs"][]=null;}return$H;}function
foreign_keys($Q){global$g,$he;static$Ee='(?:`(?:[^`]|``)+`|"(?:[^"]|"")+")';$H=array();$ub=$g->result("SHOW CREATE TABLE ".table($Q),1);if($ub){preg_match_all("~CONSTRAINT ($Ee) FOREIGN KEY ?\\(((?:$Ee,? ?)+)\\) REFERENCES ($Ee)(?:\\.($Ee))? \\(((?:$Ee,? ?)+)\\)(?: ON DELETE ($he))?(?: ON UPDATE ($he))?~",$ub,$Kd,PREG_SET_ORDER);foreach($Kd
as$A){preg_match_all("~$Ee~",$A[2],$Hf);preg_match_all("~$Ee~",$A[5],$ag);$H[idf_unescape($A[1])]=array("db"=>idf_unescape($A[4]!=""?$A[3]:$A[4]),"table"=>idf_unescape($A[4]!=""?$A[4]:$A[3]),"source"=>array_map('idf_unescape',$Hf[0]),"target"=>array_map('idf_unescape',$ag[0]),"on_delete"=>($A[6]?$A[6]:"RESTRICT"),"on_update"=>($A[7]?$A[7]:"RESTRICT"),);}}return$H;}function
view($B){global$g;return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU','',$g->result("SHOW CREATE VIEW ".table($B),1)));}function
collations(){$H=array();foreach(get_rows("SHOW COLLATION")as$I){if($I["Default"])$H[$I["Charset"]][-1]=$I["Collation"];else$H[$I["Charset"]][]=$I["Collation"];}ksort($H);foreach($H
as$y=>$X)asort($H[$y]);return$H;}function
information_schema($k){return(min_version(5)&&$k=="information_schema")||(min_version(5.5)&&$k=="performance_schema");}function
error(){global$g;return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",$g->error));}function
create_database($k,$d){return
queries("CREATE DATABASE ".idf_escape($k).($d?" COLLATE ".q($d):""));}function
drop_databases($j){$H=apply_queries("DROP DATABASE",$j,'idf_escape');restart_session();set_session("dbs",null);return$H;}function
rename_database($B,$d){$H=false;if(create_database($B,$d)){$S=array();$Sg=array();foreach(tables_list()as$Q=>$T){if($T=='VIEW')$Sg[]=$Q;else$S[]=$Q;}$H=(!$S&&!$Sg)||move_tables($S,$Sg,$B);drop_databases($H?array(DB):array());}return$H;}function
auto_increment(){$Ea=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$v){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$v["columns"],true)){$Ea="";break;}if($v["type"]=="PRIMARY")$Ea=" UNIQUE";}}return" AUTO_INCREMENT$Ea";}function
alter_table($Q,$B,$o,$zc,$fb,$Xb,$d,$Da,$Be){$c=array();foreach($o
as$n)$c[]=($n[1]?($Q!=""?($n[0]!=""?"CHANGE ".idf_escape($n[0]):"ADD"):" ")." ".implode($n[1]).($Q!=""?$n[2]:""):"DROP ".idf_escape($n[0]));$c=array_merge($c,$zc);$O=($fb!==null?" COMMENT=".q($fb):"").($Xb?" ENGINE=".q($Xb):"").($d?" COLLATE ".q($d):"").($Da!=""?" AUTO_INCREMENT=$Da":"");if($Q=="")return
queries("CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)$O$Be");if($Q!=$B)$c[]="RENAME TO ".table($B);if($O)$c[]=ltrim($O);return($c||$Be?queries("ALTER TABLE ".table($Q)."\n".implode(",\n",$c).$Be):true);}function
alter_indexes($Q,$c){foreach($c
as$y=>$X)$c[$y]=($X[2]=="DROP"?"\nDROP INDEX ".idf_escape($X[1]):"\nADD $X[0] ".($X[0]=="PRIMARY"?"KEY ":"").($X[1]!=""?idf_escape($X[1])." ":"")."(".implode(", ",$X[2]).")");return
queries("ALTER TABLE ".table($Q).implode(",",$c));}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Sg){return
queries("DROP VIEW ".implode(", ",array_map('table',$Sg)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$Sg,$ag){global$g;$ef=array();foreach($S
as$Q)$ef[]=table($Q)." TO ".idf_escape($ag).".".table($Q);if(!$ef||queries("RENAME TABLE ".implode(", ",$ef))){$Db=array();foreach($Sg
as$Q)$Db[table($Q)]=view($Q);$g->select_db($ag);$k=idf_escape(DB);foreach($Db
as$B=>$Rg){if(!queries("CREATE VIEW $B AS ".str_replace(" $k."," ",$Rg["select"]))||!queries("DROP VIEW $k.$B"))return
false;}return
true;}return
false;}function
copy_tables($S,$Sg,$ag){queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach($S
as$Q){$B=($ag==DB?table("copy_$Q"):idf_escape($ag).".".table($Q));if(($_POST["overwrite"]&&!queries("\nDROP TABLE IF EXISTS $B"))||!queries("CREATE TABLE $B LIKE ".table($Q))||!queries("INSERT INTO $B SELECT * FROM ".table($Q)))return
false;foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$I){$wg=$I["Trigger"];if(!queries("CREATE TRIGGER ".($ag==DB?idf_escape("copy_$wg"):idf_escape($ag).".".idf_escape($wg))." $I[Timing] $I[Event] ON $B FOR EACH ROW\n$I[Statement];"))return
false;}}foreach($Sg
as$Q){$B=($ag==DB?table("copy_$Q"):idf_escape($ag).".".table($Q));$Rg=view($Q);if(($_POST["overwrite"]&&!queries("DROP VIEW IF EXISTS $B"))||!queries("CREATE VIEW $B AS $Rg[select]"))return
false;}return
true;}function
trigger($B){if($B=="")return
array();$J=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($B));return
reset($J);}function
triggers($Q){$H=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$I)$H[$I["Trigger"]]=array($I["Timing"],$I["Event"]);return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
routine($B,$T){global$g,$Yb,$id,$U;$va=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$If="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$_g="((".implode("|",array_merge(array_keys($U),$va)).")\\b(?:\\s*\\(((?:[^'\")]|$Yb)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";$Ee="$If*(".($T=="FUNCTION"?"":$id).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$_g";$tb=$g->result("SHOW CREATE $T ".idf_escape($B),2);preg_match("~\\(((?:$Ee\\s*,?)*)\\)\\s*".($T=="FUNCTION"?"RETURNS\\s+$_g\\s+":"")."(.*)~is",$tb,$A);$o=array();preg_match_all("~$Ee\\s*,?~is",$A[1],$Kd,PREG_SET_ORDER);foreach($Kd
as$ze)$o[]=array("field"=>str_replace("``","`",$ze[2]).$ze[3],"type"=>strtolower($ze[5]),"length"=>preg_replace_callback("~$Yb~s",'normalize_enum',$ze[6]),"unsigned"=>strtolower(preg_replace('~\s+~',' ',trim("$ze[8] $ze[7]"))),"null"=>1,"full_type"=>$ze[4],"inout"=>strtoupper($ze[1]),"collation"=>strtolower($ze[9]),);if($T!="FUNCTION")return
array("fields"=>$o,"definition"=>$A[11]);return
array("fields"=>$o,"returns"=>array("type"=>$A[12],"length"=>$A[13],"unsigned"=>$A[15],"collation"=>$A[16]),"definition"=>$A[17],"language"=>"SQL",);}function
routines(){return
get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB));}function
routine_languages(){return
array();}function
routine_id($B,$I){return
idf_escape($B);}function
last_id(){global$g;return$g->result("SELECT LAST_INSERT_ID()");}function
explain($g,$F){return$g->query("EXPLAIN ".(min_version(5.1)&&!min_version(5.7)?"PARTITIONS ":"").$F);}function
found_rows($R,$Z){return($Z||$R["Engine"]!="InnoDB"?null:$R["Rows"]);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($pf,$h=null){return
true;}function
create_sql($Q,$Da,$Rf){global$g;$H=$g->result("SHOW CREATE TABLE ".table($Q),1);if(!$Da)$H=preg_replace('~ AUTO_INCREMENT=\d+~','',$H);return$H;}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
use_sql($i){return"USE ".idf_escape($i);}function
trigger_sql($Q){$H="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")),null,"-- ")as$I)$H.="\nCREATE TRIGGER ".idf_escape($I["Trigger"])." $I[Timing] $I[Event] ON ".table($I["Table"])." FOR EACH ROW\n$I[Statement];;\n";return$H;}function
show_variables(){return
get_key_vals("SHOW VARIABLES");}function
process_list(){return
get_rows("SHOW FULL PROCESSLIST");}function
show_status(){return
get_key_vals("SHOW STATUS");}function
convert_field($n){if(preg_match("~binary~",$n["type"]))return"HEX(".idf_escape($n["field"]).")";if($n["type"]=="bit")return"BIN(".idf_escape($n["field"])." + 0)";if(preg_match("~geometry|point|linestring|polygon~",$n["type"]))return(min_version(8)?"ST_":"")."AsWKT(".idf_escape($n["field"]).")";}function
unconvert_field($n,$H){if(preg_match("~binary~",$n["type"]))$H="UNHEX($H)";if($n["type"]=="bit")$H="CONV($H, 2, 10) + 0";if(preg_match("~geometry|point|linestring|polygon~",$n["type"]))$H=(min_version(8)?"ST_":"")."GeomFromText($H, SRID($n[field]))";return$H;}function
support($nc){return!preg_match("~scheme|sequence|type|view_trigger|materializedview".(min_version(8)?"":"|descidx".(min_version(5.1)?"":"|event|partitioning".(min_version(5)?"":"|routine|trigger|view")))."~",$nc);}function
kill_process($X){return
queries("KILL ".number($X));}function
connection_id(){return"SELECT CONNECTION_ID()";}function
max_connections(){global$g;return$g->result("SELECT @@max_connections");}function
driver_config(){$U=array();$Qf=array();foreach(array('Numbers'=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),'Date and time'=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),'Strings'=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),'Lists'=>array("enum"=>65535,"set"=>64),'Binary'=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),'Geometry'=>array("geometry"=>0,"point"=>0,"linestring"=>0,"polygon"=>0,"multipoint"=>0,"multilinestring"=>0,"multipolygon"=>0,"geometrycollection"=>0),)as$y=>$X){$U+=$X;$Qf[$y]=array_keys($X);}return
array('possible_drivers'=>array("MySQLi","MySQL","PDO_MySQL"),'jush'=>"sql",'types'=>$U,'structured_types'=>$Qf,'unsigned'=>array("unsigned","zerofill","unsigned zerofill"),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","FIND_IN_SET","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL"),'functions'=>array("char_length","date","from_unixtime","lower","round","floor","ceil","sec_to_time","time_to_sec","upper"),'grouping'=>array("avg","count","count distinct","group_concat","max","min","sum"),'edit_functions'=>array(array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1","date|time"=>"now",),array(number_type()=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",)),);}}$ib=driver_config();$Ke=$ib['possible_drivers'];$x=$ib['jush'];$U=$ib['types'];$Qf=$ib['structured_types'];$Gg=$ib['unsigned'];$me=$ib['operators'];$Gc=$ib['functions'];$Kc=$ib['grouping'];$Qb=$ib['edit_functions'];if($b->operators===null)$b->operators=$me;define("SERVER",$_GET[DRIVER]);define("DB",$_GET["db"]);define("ME",preg_replace('~\?.*~','',relative_uri()).'?'.(sid()?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));$ca="4.8.1";function
page_header($jg,$m="",$Oa=array(),$kg=""){global$ba,$ca,$b,$Lb,$x;page_headers();if(is_ajax()&&$m){page_messages($m);exit;}$lg=$jg.($kg!=""?": $kg":"");$mg=strip_tags($lg.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".$b->name());echo'<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<title>',$mg,'</title>
<link rel="stylesheet" type="text/css" href="',h(preg_replace("~\\?.*~","",ME)."?file=default.css&version=4.8.1"),'">
',script_src(preg_replace("~\\?.*~","",ME)."?file=functions.js&version=4.8.1");if($b->head()){echo'<link rel="shortcut icon" type="image/x-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.8.1"),'">
<link rel="apple-touch-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.8.1"),'">
';foreach($b->css()as$xb){echo'<link rel="stylesheet" type="text/css" href="',h($xb),'">
';}}echo'
<body class="ltr nojs">
';$p=get_temp_dir()."/adminer.version";if(!$_COOKIE["adminer_version"]&&function_exists('openssl_verify')&&file_exists($p)&&filemtime($p)+86400>time()){$Qg=unserialize(file_get_contents($p));$Se="-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwqWOVuF5uw7/+Z70djoK
RlHIZFZPO0uYRezq90+7Amk+FDNd7KkL5eDve+vHRJBLAszF/7XKXe11xwliIsFs
DFWQlsABVZB3oisKCBEuI71J4kPH8dKGEWR9jDHFw3cWmoH3PmqImX6FISWbG3B8
h7FIx3jEaw5ckVPVTeo5JRm/1DZzJxjyDenXvBQ/6o9DgZKeNDgxwKzH+sw9/YCO
jHnq1cFpOIISzARlrHMa/43YfeNRAm/tsBXjSxembBPo7aQZLAWHmaj5+K19H10B
nCpz9Y++cipkVEiKRGih4ZEvjoFysEOdRLj6WiD/uUNky4xGeA6LaJqh5XpkFkcQ
fQIDAQAB
-----END PUBLIC KEY-----
";if(openssl_verify($Qg["version"],base64_decode($Qg["signature"]),$Se)==1)$_COOKIE["adminer_version"]=$Qg["version"];}echo'<script',nonce(),'>
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick',(isset($_COOKIE["adminer_version"])?"":", onload: partial(verifyVersion, '$ca', '".js_escape(ME)."', '".get_token()."')");?>});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php echo
js_escape('You are offline.'),'\';
var thousandsSeparator = \'',js_escape(','),'\';
</script>

<div id="help" class="jush-',$x,' jsonly hidden"></div>
',script("mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});"),'
<div id="content">
';if($Oa!==null){$_=substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.h($_?$_:".").'">'.$Lb[DRIVER].'</a> &raquo; ';$_=substr(preg_replace('~\b(db|ns)=[^&]*&~','',ME),0,-1);$M=$b->serverName(SERVER);$M=($M!=""?$M:'Server');if($Oa===false)echo"$M\n";else{echo"<a href='".h($_)."' accesskey='1' title='Alt+Shift+1'>$M</a> &raquo; ";if($_GET["ns"]!=""||(DB!=""&&is_array($Oa)))echo'<a href="'.h($_."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> &raquo; ';if(is_array($Oa)){if($_GET["ns"]!="")echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> &raquo; ';foreach($Oa
as$y=>$X){$Eb=(is_array($X)?$X[1]:h($X));if($Eb!="")echo"<a href='".h(ME."$y=").urlencode(is_array($X)?$X[0]:$X)."'>$Eb</a> &raquo; ";}}echo"$jg\n";}}echo"<h2>$lg</h2>\n","<div id='ajaxstatus' class='jsonly hidden'></div>\n";restart_session();page_messages($m);$j=&get_session("dbs");if(DB!=""&&$j&&!in_array(DB,$j,true))$j=null;stop_session();define("PAGE_HEADER",1);}function
page_headers(){global$b;header("Content-Type: text/html; charset=utf-8");header("Cache-Control: no-cache");header("X-Frame-Options: deny");header("X-XSS-Protection: 0");header("X-Content-Type-Options: nosniff");header("Referrer-Policy: origin-when-cross-origin");foreach($b->csp()as$wb){$Pc=array();foreach($wb
as$y=>$X)$Pc[]="$y $X";header("Content-Security-Policy: ".implode("; ",$Pc));}$b->headers();}function
csp(){return
array(array("script-src"=>"'self' 'unsafe-inline' 'nonce-".get_nonce()."' 'strict-dynamic'","connect-src"=>"'self'","frame-src"=>"https://www.adminer.org","object-src"=>"'none'","base-uri"=>"'none'","form-action"=>"'self'",),);}function
get_nonce(){static$ae;if(!$ae)$ae=base64_encode(rand_string());return$ae;}function
page_messages($m){$Ig=preg_replace('~^[^?]*~','',$_SERVER["REQUEST_URI"]);$Rd=$_SESSION["messages"][$Ig];if($Rd){echo"<div class='message'>".implode("</div>\n<div class='message'>",$Rd)."</div>".script("messagesPrint();");unset($_SESSION["messages"][$Ig]);}if($m)echo"<div class='error'>$m</div>\n";}function
page_footer($Td=""){global$b,$pg;echo'</div>

';if($Td!="auth"){echo'<form action="" method="post">
<p class="logout">
<input type="submit" name="logout" value="Logout" id="logout">
<input type="hidden" name="token" value="',$pg,'">
</p>
</form>
';}echo'<div id="menu">
';$b->navigation($Td);echo'</div>
',script("setupSubmitHighlight(document);");}function
int32($Wd){while($Wd>=2147483648)$Wd-=4294967296;while($Wd<=-2147483649)$Wd+=4294967296;return(int)$Wd;}function
long2str($W,$Ug){$of='';foreach($W
as$X)$of.=pack('V',$X);if($Ug)return
substr($of,0,end($W));return$of;}function
str2long($of,$Ug){$W=array_values(unpack('V*',str_pad($of,4*ceil(strlen($of)/4),"\0")));if($Ug)$W[]=strlen($of);return$W;}function
xxtea_mx($eh,$dh,$Uf,$qd){return
int32((($eh>>5&0x7FFFFFF)^$dh<<2)+(($dh>>3&0x1FFFFFFF)^$eh<<4))^int32(($Uf^$dh)+($qd^$eh));}function
encrypt_string($Pf,$y){if($Pf=="")return"";$y=array_values(unpack("V*",pack("H*",md5($y))));$W=str2long($Pf,true);$Wd=count($W)-1;$eh=$W[$Wd];$dh=$W[0];$Te=floor(6+52/($Wd+1));$Uf=0;while($Te-->0){$Uf=int32($Uf+0x9E3779B9);$Pb=$Uf>>2&3;for($xe=0;$xe<$Wd;$xe++){$dh=$W[$xe+1];$Vd=xxtea_mx($eh,$dh,$Uf,$y[$xe&3^$Pb]);$eh=int32($W[$xe]+$Vd);$W[$xe]=$eh;}$dh=$W[0];$Vd=xxtea_mx($eh,$dh,$Uf,$y[$xe&3^$Pb]);$eh=int32($W[$Wd]+$Vd);$W[$Wd]=$eh;}return
long2str($W,false);}function
decrypt_string($Pf,$y){if($Pf=="")return"";if(!$y)return
false;$y=array_values(unpack("V*",pack("H*",md5($y))));$W=str2long($Pf,false);$Wd=count($W)-1;$eh=$W[$Wd];$dh=$W[0];$Te=floor(6+52/($Wd+1));$Uf=int32($Te*0x9E3779B9);while($Uf){$Pb=$Uf>>2&3;for($xe=$Wd;$xe>0;$xe--){$eh=$W[$xe-1];$Vd=xxtea_mx($eh,$dh,$Uf,$y[$xe&3^$Pb]);$dh=int32($W[$xe]-$Vd);$W[$xe]=$dh;}$eh=$W[$Wd];$Vd=xxtea_mx($eh,$dh,$Uf,$y[$xe&3^$Pb]);$dh=int32($W[0]-$Vd);$W[0]=$dh;$Uf=int32($Uf-0x9E3779B9);}return
long2str($W,true);}$g='';$Oc=$_SESSION["token"];if(!$Oc)$_SESSION["token"]=rand(1,1e6);$pg=get_token();$Ge=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$X){list($y)=explode(":",$X);$Ge[$y]=$X;}}function
add_invalid_login(){global$b;$Ec=file_open_lock(get_temp_dir()."/adminer.invalid");if(!$Ec)return;$ld=unserialize(stream_get_contents($Ec));$gg=time();if($ld){foreach($ld
as$md=>$X){if($X[0]<$gg)unset($ld[$md]);}}$kd=&$ld[$b->bruteForceKey()];if(!$kd)$kd=array($gg+30*60,0);$kd[1]++;file_write_unlock($Ec,serialize($ld));}function
check_invalid_login(){global$b;$ld=unserialize(@file_get_contents(get_temp_dir()."/adminer.invalid"));$kd=($ld?$ld[$b->bruteForceKey()]:array());$Zd=($kd[1]>29?$kd[0]-time():0);if($Zd>0)auth_error(lang(array('Too many unsuccessful logins, try again in %d minute.','Too many unsuccessful logins, try again in %d minutes.'),ceil($Zd/60)));}$Ba=$_POST["auth"];if($Ba){session_regenerate_id();$Pg=$Ba["driver"];$M=$Ba["server"];$V=$Ba["username"];$E=(string)$Ba["password"];$k=$Ba["db"];set_password($Pg,$M,$V,$E);$_SESSION["db"][$Pg][$M][$V][$k]=true;if($Ba["permanent"]){$y=base64_encode($Pg)."-".base64_encode($M)."-".base64_encode($V)."-".base64_encode($k);$Pe=$b->permanentLogin(true);$Ge[$y]="$y:".base64_encode($Pe?encrypt_string($E,$Pe):"");cookie("adminer_permanent",implode(" ",$Ge));}if(count($_POST)==1||DRIVER!=$Pg||SERVER!=$M||$_GET["username"]!==$V||DB!=$k)redirect(auth_url($Pg,$M,$V,$k));}elseif($_POST["logout"]&&(!$Oc||verify_token())){foreach(array("pwds","db","dbs","queries")as$y)set_session($y,null);unset_permanent();redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1),'Logout successful.'.' '.'Thanks for using Adminer, consider <a href="https://www.adminer.org/en/donation/">donating</a>.');}elseif($Ge&&!$_SESSION["pwds"]){session_regenerate_id();$Pe=$b->permanentLogin();foreach($Ge
as$y=>$X){list(,$Va)=explode(":",$X);list($Pg,$M,$V,$k)=array_map('base64_decode',explode("-",$y));set_password($Pg,$M,$V,decrypt_string(base64_decode($Va),$Pe));$_SESSION["db"][$Pg][$M][$V][$k]=true;}}function
unset_permanent(){global$Ge;foreach($Ge
as$y=>$X){list($Pg,$M,$V,$k)=array_map('base64_decode',explode("-",$y));if($Pg==DRIVER&&$M==SERVER&&$V==$_GET["username"]&&$k==DB)unset($Ge[$y]);}cookie("adminer_permanent",implode(" ",$Ge));}function
auth_error($m){global$b,$Oc;$Af=session_name();if(isset($_GET["username"])){header("HTTP/1.1 403 Forbidden");if(($_COOKIE[$Af]||$_GET[$Af])&&!$Oc)$m='Session expired, please login again.';else{restart_session();add_invalid_login();$E=get_password();if($E!==null){if($E===false)$m.=($m?'<br>':'').sprintf('Master password expired. <a href="https://www.adminer.org/en/extension/"%s>Implement</a> %s method to make it permanent.',target_blank(),'<code>permanentLogin()</code>');set_password(DRIVER,SERVER,$_GET["username"],null);}unset_permanent();}}if(!$_COOKIE[$Af]&&$_GET[$Af]&&ini_bool("session.use_only_cookies"))$m='Session support must be enabled.';$_e=session_get_cookie_params();cookie("adminer_key",($_COOKIE["adminer_key"]?$_COOKIE["adminer_key"]:rand_string()),$_e["lifetime"]);page_header('Login',$m,null);echo"<form action='' method='post'>\n","<div>";if(hidden_fields($_POST,array("auth")))echo"<p class='message'>".'The action will be performed after successful login with the same credentials.'."\n";echo"</div>\n";$b->loginForm();echo"</form>\n";page_footer("auth");exit;}if(isset($_GET["username"])&&!class_exists("Min_DB")){unset($_SESSION["pwds"][DRIVER]);unset_permanent();page_header('No extension',sprintf('None of the supported PHP extensions (%s) are available.',implode(", ",$Ke)),false);page_footer("auth");exit;}stop_session(true);if(isset($_GET["username"])&&is_string(get_password())){list($Uc,$Ie)=explode(":",SERVER,2);if(preg_match('~^\s*([-+]?\d+)~',$Ie,$A)&&($A[1]<1024||$A[1]>65535))auth_error('Connecting to privileged ports is not allowed.');check_invalid_login();$g=connect();$l=new
Min_Driver($g);}$Ed=null;if(!is_object($g)||($Ed=$b->login($_GET["username"],get_password()))!==true){$m=(is_string($g)?h($g):(is_string($Ed)?$Ed:'Invalid credentials.'));auth_error($m.(preg_match('~^ | $~',get_password())?'<br>'.'There is a space in the input password which might be the cause.':''));}if($_POST["logout"]&&$Oc&&!verify_token()){page_header('Logout','Invalid CSRF token. Send the form again.');page_footer("db");exit;}if($Ba&&$_POST["token"])$_POST["token"]=$pg;$m='';if($_POST){if(!verify_token()){$hd="max_input_vars";$Od=ini_get($hd);if(extension_loaded("suhosin")){foreach(array("suhosin.request.max_vars","suhosin.post.max_vars")as$y){$X=ini_get($y);if($X&&(!$Od||$X<$Od)){$hd=$y;$Od=$X;}}}$m=(!$_POST["token"]&&$Od?sprintf('Maximum number of allowed fields exceeded. Please increase %s.',"'$hd'"):'Invalid CSRF token. Send the form again.'.' '.'If you did not send this request from Adminer then close this page.');}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$m=sprintf('Too big POST data. Reduce the data or increase the %s configuration directive.',"'post_max_size'");if(isset($_GET["sql"]))$m.=' '.'You can upload a big SQL file via FTP and import it from server.';}function
email_header($Pc){return"=?UTF-8?B?".base64_encode($Pc)."?=";}function
send_mail($Tb,$Sf,$Qd,$Fc="",$rc=array()){$Zb=(DIRECTORY_SEPARATOR=="/"?"\n":"\r\n");$Qd=str_replace("\n",$Zb,wordwrap(str_replace("\r","","$Qd\n")));$Na=uniqid("boundary");$_a="";foreach((array)$rc["error"]as$y=>$X){if(!$X)$_a.="--$Na$Zb"."Content-Type: ".str_replace("\n","",$rc["type"][$y]).$Zb."Content-Disposition: attachment; filename=\"".preg_replace('~["\n]~','',$rc["name"][$y])."\"$Zb"."Content-Transfer-Encoding: base64$Zb$Zb".chunk_split(base64_encode(file_get_contents($rc["tmp_name"][$y])),76,$Zb).$Zb;}$Ja="";$Qc="Content-Type: text/plain; charset=utf-8$Zb"."Content-Transfer-Encoding: 8bit";if($_a){$_a.="--$Na--$Zb";$Ja="--$Na$Zb$Qc$Zb$Zb";$Qc="Content-Type: multipart/mixed; boundary=\"$Na\"";}$Qc.=$Zb."MIME-Version: 1.0$Zb"."X-Mailer: Adminer Editor".($Fc?$Zb."From: ".str_replace("\n","",$Fc):"");return
mail($Tb,email_header($Sf),$Ja.$Qd.$_a,$Qc);}function
like_bool($n){return
preg_match("~bool|(tinyint|bit)\\(1\\)~",$n["full_type"]);}$g->select_db($b->database());$he="RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";$Lb[DRIVER]='Login';if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"])$_GET["edit"]=$_GET["select"];if(isset($_GET["download"])){$a=$_GET["download"];$o=fields($a);header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$a-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));$K=array(idf_escape($_GET["field"]));$G=$l->select($a,$K,array(where($_GET,$o)),$K);$I=($G?$G->fetch_row():array());echo$l->value($I[0],$o[$_GET["field"]]);exit;}elseif(isset($_GET["edit"])){$a=$_GET["edit"];$o=fields($a);$Z=(isset($_GET["select"])?($_POST["check"]&&count($_POST["check"])==1?where_check($_POST["check"][0],$o):""):where($_GET,$o));$Hg=(isset($_GET["select"])?$_POST["edit"]:$Z);foreach($o
as$B=>$n){if(!isset($n["privileges"][$Hg?"update":"insert"])||$b->fieldName($n)==""||$n["generated"])unset($o[$B]);}if($_POST&&!$m&&!isset($_GET["select"])){$Dd=$_POST["referer"];if($_POST["insert"])$Dd=($Hg?null:$_SERVER["REQUEST_URI"]);elseif(!preg_match('~^.+&select=.+$~',$Dd))$Dd=ME."select=".urlencode($a);$w=indexes($a);$Cg=unique_array($_GET["where"],$w);$We="\nWHERE $Z";if(isset($_POST["delete"]))queries_redirect($Dd,'Item has been deleted.',$l->delete($a,$We,!$Cg));else{$N=array();foreach($o
as$B=>$n){$X=process_input($n);if($X!==false&&$X!==null)$N[idf_escape($B)]=$X;}if($Hg){if(!$N)redirect($Dd);queries_redirect($Dd,'Item has been updated.',$l->update($a,$N,$We,!$Cg));if(is_ajax()){page_headers();page_messages($m);exit;}}else{$G=$l->insert($a,$N);$yd=($G?last_id():0);queries_redirect($Dd,sprintf('Item%s has been inserted.',($yd?" $yd":"")),$G);}}}$I=null;if($_POST["save"])$I=(array)$_POST["fields"];elseif($Z){$K=array();foreach($o
as$B=>$n){if(isset($n["privileges"]["select"])){$ya=convert_field($n);if($_POST["clone"]&&$n["auto_increment"])$ya="''";if($x=="sql"&&preg_match("~enum|set~",$n["type"]))$ya="1*".idf_escape($B);$K[]=($ya?"$ya AS ":"").idf_escape($B);}}$I=array();if(!support("table"))$K=array("*");if($K){$G=$l->select($a,$K,array($Z),$K,array(),(isset($_GET["select"])?2:1));if(!$G)$m=error();else{$I=$G->fetch_assoc();if(!$I)$I=false;}if(isset($_GET["select"])&&(!$I||$G->fetch_assoc()))$I=null;}}if(!support("table")&&!$o){if(!$Z){$G=$l->select($a,array("*"),$Z,array("*"));$I=($G?$G->fetch_assoc():false);if(!$I)$I=array($l->primary=>"");}if($I){foreach($I
as$y=>$X){if(!$Z)$I[$y]=null;$o[$y]=array("field"=>$y,"null"=>($y!=$l->primary),"auto_increment"=>($y==$l->primary));}}}edit_form($a,$o,$I,$Hg);}elseif(isset($_GET["select"])){$a=$_GET["select"];$R=table_status1($a);$w=indexes($a);$o=fields($a);$Bc=column_foreign_keys($a);$fe=$R["Oid"];parse_str($_COOKIE["adminer_import"],$sa);$mf=array();$f=array();$eg=null;foreach($o
as$y=>$n){$B=$b->fieldName($n);if(isset($n["privileges"]["select"])&&$B!=""){$f[$y]=html_entity_decode(strip_tags($B),ENT_QUOTES);if(is_shortable($n))$eg=$b->selectLengthProcess();}$mf+=$n["privileges"];}list($K,$Hc)=$b->selectColumnsProcess($f,$w);$nd=count($Hc)<count($K);$Z=$b->selectSearchProcess($o,$w);$pe=$b->selectOrderProcess($o,$w);$z=$b->selectLimitProcess();if($_GET["val"]&&is_ajax()){header("Content-Type: text/plain; charset=utf-8");foreach($_GET["val"]as$Dg=>$I){$ya=convert_field($o[key($I)]);$K=array($ya?$ya:idf_escape(key($I)));$Z[]=where_check($Dg,$o);$H=$l->select($a,$K,$Z,$K);if($H)echo
reset($H->fetch_row());}exit;}$Me=$Fg=null;foreach($w
as$v){if($v["type"]=="PRIMARY"){$Me=array_flip($v["columns"]);$Fg=($K?$Me:array());foreach($Fg
as$y=>$X){if(in_array(idf_escape($y),$K))unset($Fg[$y]);}break;}}if($fe&&!$Me){$Me=$Fg=array($fe=>0);$w[]=array("type"=>"PRIMARY","columns"=>array($fe));}if($_POST&&!$m){$Zg=$Z;if(!$_POST["all"]&&is_array($_POST["check"])){$Ua=array();foreach($_POST["check"]as$Ra)$Ua[]=where_check($Ra,$o);$Zg[]="((".implode(") OR (",$Ua)."))";}$Zg=($Zg?"\nWHERE ".implode(" AND ",$Zg):"");if($_POST["export"]){cookie("adminer_import","output=".urlencode($_POST["output"])."&format=".urlencode($_POST["format"]));dump_headers($a);$b->dumpTable($a,"");$Fc=($K?implode(", ",$K):"*").convert_fields($f,$o,$K)."\nFROM ".table($a);$Jc=($Hc&&$nd?"\nGROUP BY ".implode(", ",$Hc):"").($pe?"\nORDER BY ".implode(", ",$pe):"");if(!is_array($_POST["check"])||$Me)$F="SELECT $Fc$Zg$Jc";else{$Bg=array();foreach($_POST["check"]as$X)$Bg[]="(SELECT".limit($Fc,"\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$o).$Jc,1).")";$F=implode(" UNION ALL ",$Bg);}$b->dumpData($a,"table",$F);exit;}if(!$b->selectEmailProcess($Z,$Bc)){if($_POST["save"]||$_POST["delete"]){$G=true;$ta=0;$N=array();if(!$_POST["delete"]){foreach($f
as$B=>$X){$X=process_input($o[$B]);if($X!==null&&($_POST["clone"]||$X!==false))$N[idf_escape($B)]=($X!==false?$X:idf_escape($B));}}if($_POST["delete"]||$N){if($_POST["clone"])$F="INTO ".table($a)." (".implode(", ",array_keys($N)).")\nSELECT ".implode(", ",$N)."\nFROM ".table($a);if($_POST["all"]||($Me&&is_array($_POST["check"]))||$nd){$G=($_POST["delete"]?$l->delete($a,$Zg):($_POST["clone"]?queries("INSERT $F$Zg"):$l->update($a,$N,$Zg)));$ta=$g->affected_rows;}else{foreach((array)$_POST["check"]as$X){$Vg="\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$o);$G=($_POST["delete"]?$l->delete($a,$Vg,1):($_POST["clone"]?queries("INSERT".limit1($a,$F,$Vg)):$l->update($a,$N,$Vg,1)));if(!$G)break;$ta+=$g->affected_rows;}}}$Qd=lang(array('%d item has been affected.','%d items have been affected.'),$ta);if($_POST["clone"]&&$G&&$ta==1){$yd=last_id();if($yd)$Qd=sprintf('Item%s has been inserted.'," $yd");}queries_redirect(remove_from_uri($_POST["all"]&&$_POST["delete"]?"page":""),$Qd,$G);if(!$_POST["delete"]){edit_form($a,$o,(array)$_POST["fields"],!$_POST["clone"]);page_footer();exit;}}elseif(!$_POST["import"]){if(!$_POST["val"])$m='Ctrl+click on a value to modify it.';else{$G=true;$ta=0;foreach($_POST["val"]as$Dg=>$I){$N=array();foreach($I
as$y=>$X){$y=bracket_escape($y,1);$N[idf_escape($y)]=(preg_match('~char|text~',$o[$y]["type"])||$X!=""?$b->processInput($o[$y],$X):"NULL");}$G=$l->update($a,$N," WHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($Dg,$o),!$nd&&!$Me," ");if(!$G)break;$ta+=$g->affected_rows;}queries_redirect(remove_from_uri(),lang(array('%d item has been affected.','%d items have been affected.'),$ta),$G);}}elseif(!is_string($qc=get_file("csv_file",true)))$m=upload_error($qc);elseif(!preg_match('~~u',$qc))$m='File must be in UTF-8 encoding.';else{cookie("adminer_import","output=".urlencode($sa["output"])."&format=".urlencode($_POST["separator"]));$G=true;$cb=array_keys($o);preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~',$qc,$Kd);$ta=count($Kd[0]);$l->begin();$L=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));$J=array();foreach($Kd[0]as$y=>$X){preg_match_all("~((?>\"[^\"]*\")+|[^$L]*)$L~",$X.$L,$Ld);if(!$y&&!array_diff($Ld[1],$cb)){$cb=$Ld[1];$ta--;}else{$N=array();foreach($Ld[1]as$s=>$Za)$N[idf_escape($cb[$s])]=($Za==""&&$o[$cb[$s]]["null"]?"NULL":q(str_replace('""','"',preg_replace('~^"|"$~','',$Za))));$J[]=$N;}}$G=(!$J||$l->insertUpdate($a,$J,$Me));if($G)$G=$l->commit();queries_redirect(remove_from_uri("page"),lang(array('%d row has been imported.','%d rows have been imported.'),$ta),$G);$l->rollback();}}}$Xf=$b->tableName($R);if(is_ajax()){page_headers();ob_start();}else
page_header('Select'.": $Xf",$m);$N=null;if(isset($mf["insert"])||!support("table")){$N="";foreach((array)$_GET["where"]as$X){if($Bc[$X["col"]]&&count($Bc[$X["col"]])==1&&($X["op"]=="="||(!$X["op"]&&!preg_match('~[_%]~',$X["val"]))))$N.="&set".urlencode("[".bracket_escape($X["col"])."]")."=".urlencode($X["val"]);}}$b->selectLinks($R,$N);if(!$f&&support("table"))echo"<p class='error'>".'Unable to select the table'.($o?".":": ".error())."\n";else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?'<input type="hidden" name="db" value="'.h(DB).'">'.(isset($_GET["ns"])?'<input type="hidden" name="ns" value="'.h($_GET["ns"]).'">':""):"");echo'<input type="hidden" name="select" value="'.h($a).'">',"</div>\n";$b->selectColumnsPrint($K,$f);$b->selectSearchPrint($Z,$f,$w);$b->selectOrderPrint($pe,$f,$w);$b->selectLimitPrint($z);$b->selectLengthPrint($eg);$b->selectActionPrint($w);echo"</form>\n";$D=$_GET["page"];if($D=="last"){$Dc=$g->result(count_rows($a,$Z,$nd,$Hc));$D=floor(max(0,$Dc-1)/$z);}$sf=$K;$Ic=$Hc;if(!$sf){$sf[]="*";$qb=convert_fields($f,$o,$K);if($qb)$sf[]=substr($qb,2);}foreach($K
as$y=>$X){$n=$o[idf_unescape($X)];if($n&&($ya=convert_field($n)))$sf[$y]="$ya AS $X";}if(!$nd&&$Fg){foreach($Fg
as$y=>$X){$sf[]=idf_escape($y);if($Ic)$Ic[]=idf_escape($y);}}$G=$l->select($a,$sf,$Z,$Ic,$pe,$z,$D,true);if(!$G)echo"<p class='error'>".error()."\n";else{if($x=="mssql"&&$D)$G->seek($z*$D);$Vb=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$J=array();while($I=$G->fetch_assoc()){if($D&&$x=="oracle")unset($I["RNUM"]);$J[]=$I;}if($_GET["page"]!="last"&&$z!=""&&$Hc&&$nd&&$x=="sql")$Dc=$g->result(" SELECT FOUND_ROWS()");if(!$J)echo"<p class='message'>".'No rows.'."\n";else{$Ia=$b->backwardKeys($a,$Xf);echo"<div class='scrollable'>","<table id='table' cellspacing='0' class='nowrap checkable'>",script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"),"<thead><tr>".(!$Hc&&$K?"":"<td><input type='checkbox' id='all-page' class='jsonly'>".script("qs('#all-page').onclick = partial(formCheck, /check/);","")." <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."'>".'Modify'."</a>");$Xd=array();$Gc=array();reset($K);$Ye=1;foreach($J[0]as$y=>$X){if(!isset($Fg[$y])){$X=$_GET["columns"][key($K)];$n=$o[$K?($X?$X["col"]:current($K)):$y];$B=($n?$b->fieldName($n,$Ye):($X["fun"]?"*":$y));if($B!=""){$Ye++;$Xd[$y]=$B;$e=idf_escape($y);$Vc=remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($y);$Eb="&desc%5B0%5D=1";echo"<th id='th[".h(bracket_escape($y))."]'>".script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});",""),'<a href="'.h($Vc.($pe[0]==$e||$pe[0]==$y||(!$pe&&$nd&&$Hc[0]==$e)?$Eb:'')).'">';echo
apply_sql_function($X["fun"],$B)."</a>";echo"<span class='column hidden'>","<a href='".h($Vc.$Eb)."' title='".'descending'."' class='text'> ‚Üì</a>";if(!$X["fun"]){echo'<a href="#fieldset-search" title="'.'Search'.'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($y)."');");}echo"</span>";}$Gc[$y]=$X["fun"];next($K);}}$Ad=array();if($_GET["modify"]){foreach($J
as$I){foreach($I
as$y=>$X)$Ad[$y]=max($Ad[$y],min(40,strlen(utf8_decode($X))));}}echo($Ia?"<th>".'Relations':"")."</thead>\n";if(is_ajax()){if($z%2==1&&$D%2==1)odd();ob_end_clean();}foreach($b->rowDescriptions($J,$Bc)as$Wd=>$I){$Cg=unique_array($J[$Wd],$w);if(!$Cg){$Cg=array();foreach($J[$Wd]as$y=>$X){if(!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~',$y))$Cg[$y]=$X;}}$Dg="";foreach($Cg
as$y=>$X){if(($x=="sql"||$x=="pgsql")&&preg_match('~char|text|enum|set~',$o[$y]["type"])&&strlen($X)>64){$y=(strpos($y,'(')?$y:idf_escape($y));$y="MD5(".($x!='sql'||preg_match("~^utf8~",$o[$y]["collation"])?$y:"CONVERT($y USING ".charset($g).")").")";$X=md5($X);}$Dg.="&".($X!==null?urlencode("where[".bracket_escape($y)."]")."=".urlencode($X):"null%5B%5D=".urlencode($y));}echo"<tr".odd().">".(!$Hc&&$K?"":"<td>".checkbox("check[]",substr($Dg,1),in_array(substr($Dg,1),(array)$_POST["check"])).($nd||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$Dg)."' class='edit'>".'edit'."</a>"));foreach($I
as$y=>$X){if(isset($Xd[$y])){$n=$o[$y];$X=$l->value($X,$n);if($X!=""&&(!isset($Vb[$y])||$Vb[$y]!=""))$Vb[$y]=(is_mail($X)?$Xd[$y]:"");$_="";if(preg_match('~blob|bytea|raw|file~',$n["type"])&&$X!="")$_=ME.'download='.urlencode($a).'&field='.urlencode($y).$Dg;if(!$_&&$X!==null){foreach((array)$Bc[$y]as$q){if(count($Bc[$y])==1||end($q["source"])==$y){$_="";foreach($q["source"]as$s=>$Hf)$_.=where_link($s,$q["target"][$s],$J[$Wd][$Hf]);$_=($q["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($q["db"]),ME):ME).'select='.urlencode($q["table"]).$_;if($q["ns"])$_=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($q["ns"]),$_);if(count($q["source"])==1)break;}}}if($y=="COUNT(*)"){$_=ME."select=".urlencode($a);$s=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$Cg))$_.=where_link($s++,$W["col"],$W["val"],$W["op"]);}foreach($Cg
as$qd=>$W)$_.=where_link($s++,$qd,$W);}$X=select_value($X,$_,$n,$eg);$t=h("val[$Dg][".bracket_escape($y)."]");$Y=$_POST["val"][$Dg][bracket_escape($y)];$Rb=!is_array($I[$y])&&is_utf8($X)&&$J[$Wd][$y]==$I[$y]&&!$Gc[$y];$dg=preg_match('~text|lob~',$n["type"]);echo"<td id='$t'";if(($_GET["modify"]&&$Rb)||$Y!==null){$Lc=h($Y!==null?$Y:$I[$y]);echo">".($dg?"<textarea name='$t' cols='30' rows='".(substr_count($I[$y],"\n")+1)."'>$Lc</textarea>":"<input name='$t' value='$Lc' size='$Ad[$y]'>");}else{$Fd=strpos($X,"<i>‚Ä¶</i>");echo" data-text='".($Fd?2:($dg?1:0))."'".($Rb?"":" data-warning='".h('Use edit link to modify this value.')."'").">$X</td>";}}}if($Ia)echo"<td>";$b->backwardKeysPrint($Ia,$J[$Wd]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n","</div>\n";}if(!is_ajax()){if($J||$D){$ec=true;if($_GET["page"]!="last"){if($z==""||(count($J)<$z&&($J||!$D)))$Dc=($D?$D*$z:0)+count($J);elseif($x!="sql"||!$nd){$Dc=($nd?false:found_rows($R,$Z));if($Dc<max(1e4,2*($D+1)*$z))$Dc=reset(slow_query(count_rows($a,$Z,$nd,$Hc)));else$ec=false;}}$ye=($z!=""&&($Dc===false||$Dc>$z||$D));if($ye){echo(($Dc===false?count($J)+1:$Dc-$D*$z)>$z?'<p><a href="'.h(remove_from_uri("page")."&page=".($D+1)).'" class="loadmore">'.'Load more data'.'</a>'.script("qsl('a').onclick = partial(selectLoadMore, ".(+$z).", '".'Loading'."‚Ä¶');",""):''),"\n";}}echo"<div class='footer'><div>\n";if($J||$D){if($ye){$Md=($Dc===false?$D+(count($J)>=$z?2:1):floor(($Dc-1)/$z));echo"<fieldset>";if($x!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".'Page'."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".'Page'."', '".($D+1)."')); return false; };"),pagination(0,$D).($D>5?" ‚Ä¶":"");for($s=max(1,$D-4);$s<min($Md,$D+5);$s++)echo
pagination($s,$D);if($Md>0){echo($D+5<$Md?" ‚Ä¶":""),($ec&&$Dc!==false?pagination($Md,$D):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Md'>".'last'."</a>");}}else{echo"<legend>".'Page'."</legend>",pagination(0,$D).($D>1?" ‚Ä¶":""),($D?pagination($D,$D):""),($Md>$D?pagination($D+1,$D).($Md>$D+1?" ‚Ä¶":""):"");}echo"</fieldset>\n";}echo"<fieldset>","<legend>".'Whole result'."</legend>";$Jb=($ec?"":"~ ").$Dc;echo
checkbox("all",1,0,($Dc!==false?($ec?"":"~ ").lang(array('%d row','%d rows'),$Dc):""),"var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$Jb' : checked); selectCount('selected2', this.checked || !checked ? '$Jb' : checked);")."\n","</fieldset>\n";if($b->selectCommandPrint()){echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>Modify</legend><div>
<input type="submit" value="Save"',($_GET["modify"]?'':' title="'.'Ctrl+click on a value to modify it.'.'"'),'>
</div></fieldset>
<fieldset><legend>Selected <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="Edit">
<input type="submit" name="clone" value="Clone">
<input type="submit" name="delete" value="Delete">',confirm(),'</div></fieldset>
';}$Cc=$b->dumpFormat();foreach((array)$_GET["columns"]as$e){if($e["fun"]){unset($Cc['sql']);break;}}if($Cc){print_fieldset("export",'Export'." <span id='selected2'></span>");$ve=$b->dumpOutput();echo($ve?html_select("output",$ve,$sa["output"])." ":""),html_select("format",$Cc,$sa["format"])," <input type='submit' name='export' value='".'Export'."'>\n","</div></fieldset>\n";}$b->selectEmailPrint(array_filter($Vb,'strlen'),$f);}echo"</div></div>\n";if($b->selectImportPrint()){echo"<div>","<a href='#import'>".'Import'."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import' class='hidden'>: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$sa["format"],1);echo" <input type='submit' name='import' value='".'Import'."'>","</span>","</div>";}echo"<input type='hidden' name='token' value='$pg'>\n","</form>\n",(!$Hc&&$K?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["script"])){if($_GET["script"]=="kill")$g->query("KILL ".number($_POST["kill"]));elseif(list($Q,$t,$B)=$b->_foreignColumn(column_foreign_keys($_GET["source"]),$_GET["field"])){$z=11;$G=$g->query("SELECT $t, $B FROM ".table($Q)." WHERE ".(preg_match('~^[0-9]+$~',$_GET["value"])?"$t = $_GET[value] OR ":"")."$B LIKE ".q("$_GET[value]%")." ORDER BY 2 LIMIT $z");for($s=1;($I=$G->fetch_row())&&$s<$z;$s++)echo"<a href='".h(ME."edit=".urlencode($Q)."&where".urlencode("[".bracket_escape(idf_unescape($t))."]")."=".urlencode($I[0]))."'>".h($I[1])."</a><br>\n";if($I)echo"...\n";}exit;}else{page_header('Server',"",false);if($b->homepage()){echo"<form action='' method='post'>\n","<p>".'Search data in tables'.": <input type='search' name='query' value='".h($_POST["query"])."'> <input type='submit' value='".'Search'."'>\n";if($_POST["query"]!="")search_tables();echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^tables\[/);",""),'<th>'.'Table','<td>'.'Rows',"</thead>\n";foreach(table_status()as$Q=>$I){$B=$b->tableName($I);if(isset($I["Engine"])&&$B!=""){echo'<tr'.odd().'><td>'.checkbox("tables[]",$Q,in_array($Q,(array)$_POST["tables"],true)),"<th><a href='".h(ME).'select='.urlencode($Q)."'>$B</a>";$X=format_number($I["Rows"]);echo"<td align='right'><a href='".h(ME."edit=").urlencode($Q)."'>".($I["Engine"]=="InnoDB"&&$X?"~ $X":$X)."</a>";}}echo"</table>\n","</div>\n","</form>\n",script("tableCheck();");}}page_footer();