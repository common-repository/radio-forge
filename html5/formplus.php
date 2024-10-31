<?php
//include_once("db.php");
include_once("function.php");

global $wpdb;
$table		=	$wpdb->prefix."radioforge_radio";

if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
 $id = (int) $_REQUEST['id'];
else
 $id = 0;


$results = $wpdb->get_results( $wpdb->prepare( "select * from $table where id = %d ", $id ) );


//echo "<pre>"; print_r($docdata); print_r($results);


$prms = json_decode($results[0]->params);

//print_r($prms);

/* Save Playlist */

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Embed Code")
{

include("saveplus.php");

}


 

?>
	 
<?php if(isset($_REQUEST['page']) && $_REQUEST['page']=="radioforge-options") { ?>
<h2>Manage Radio</h2>	 <br />
<?php } ?>


<strong>Radio Forge&nbsp;<?php /*?><a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=radioforge_radio" style="background-color:#D84937; padding:5px; height:35px; color:#ffffff; font-weight:bold;">Home</a><?php */?></strong> <br /><br />	


	 
 <form name="frm" action="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=radioforge_add_radio&action=update&id=<?php echo $_REQUEST['id']; ?>" method="post">
		
 
    <table class="form-table">
      <?php if (function_exists('wp_nonce_field')) { wp_nonce_field('shoutcast-icecast-html5-player-updatesettings'); } ?>
       
      
      
            
      <tr>
        <th scope="row" valign="top"><label for="radiolink">Radio Stream Link:</label></th>
        <td><input type="text" name="url" id="url" class="regular-text" value="<?php echo $prms->url; ?>"/>  
        
        <div style="color:#ff0000"><strong>Shoutcast V1</strong> (http://shoutcast-server-ip:port/) <br />
<strong>Shoutcast V2</strong> (http://shoutcast-server-ip:port/streamname) <br />
<strong>Icecast</strong> (http://icecast-server-ip:port/streamname)	</div>

        <?php /*?><div style="color:#ff0000"><strong>Note</strong>: Please make sure shoutcast / icecast server port is open on your server firewall as outgoing port to read shoutcast / icecast current playing song information...</div><?php */?>
        
        


</td>
      </tr>
      
      
      
      
      <tr>
        <th scope="row" valign="top"><label for="radiotype">Audio Codec:</label></th>
        
        <td>
        <select name="codec" id="codec">
        <option value="mp3" <?php if($prms->codec=="mp3") echo ' selected="selected"'; ?>>MP3</option>
        <option value="aac" <?php if($prms->codec=="aac") echo ' selected="selected"'; ?>>AAC</option>
        <option value="ogg" <?php if($prms->codec=="ogg") echo ' selected="selected"'; ?>>OGG</option>
        </select>
        </td>
      </tr>
      
      
      
      <tr>
        <th scope="row" valign="top"><label for="radiotype">Radio Type:</label></th>
        
        <td>
        <select name="radiotype" id="radiotype">
        <option value="shoutcast1" <?php if($prms->radiotype=="shoutcast1") echo ' selected="selected"'; ?>>Shoutcast 1</option>
        <option value="shoutcast2" <?php if($prms->radiotype=="shoutcast2") echo ' selected="selected"'; ?>>Shoutcast 2</option>
        <option value="icecast" <?php if($prms->radiotype=="icecast") echo ' selected="selected"'; ?>>Icecast</option>
        </select>
        </td>
      </tr>
      
      
      
      
      
        <tr>
        <th scope="row" valign="top"><label for="player">Intro File URL (only MP3):</label></th>
        
        <td>
        <input class="regular-text" name="introurl" id="introurl" type="text" value="<?php echo $prms->introurl; ?>" placeholder="http://www.domain.com/music.mp3" />
        </td>
      </tr>
     
      
      
<?php /*?>      <tr>
        <th scope="row" valign="top"><label for="player">Player In Background:</label></th>
        
        <td>
        #<input class="color" name="bcolor" type="text" value="<?php echo $bcolor; ?>" />
        </td>
      </tr><?php */?>
      
      
      
<?php /*?>      <tr>
        <th scope="row" valign="top"><label for="player">Player Out Background:</label></th>
        
        <td>
        #<input class="color" name="background" type="text" value="<?php echo $background; ?>" />  (if Player Background Image is blank)
        </td>
      </tr><?php */?>
      
      
<?php /*?>      <tr>
        <th scope="row" valign="top"><label for="player">Player Shadow:</label></th>
        
        <td>
        <input name="shadow" type="checkbox" value="1" <?php if( $shadow ) { ?> checked="checked" <?php } ?> />
        </td>
      </tr><?php */?>
      
      
      <tr>
        <th scope="row" valign="top"><label for="player">Welcome Message:</label></th>
        
        <td>
        <input name="welcome" id="welcome" type="text" class="regular-text" value="<?php echo $prms->welcome; ?>" placeholder="Welcome to RadioForge.com"  />
        </td>
      </tr>
      
      
      
      
      <tr>
        <th scope="row" valign="top"><label for="player">Player Autoplay:</label></th>
        
        <td>
        
        <select name="autoplay" id="autoplay">
        <option value="true">True</option>
        <option value="false">False</option>
        </select>
        
        
        <?php /*?><input name="autoplay" id="autoplay" type="checkbox" value="true" <?php if( $prms->autoplay ) { ?> checked="checked" <?php } ?> /><?php */?>
        </td>
      </tr>
      
      
      <?php /*?><tr>
        <th scope="row" valign="top"><label for="player">Song Metadata:</label></th>
        
        <td>
        <input name="metadata" type="checkbox" value="1" <?php if( $metadata ) { ?> checked="checked" <?php } ?> />
        </td>
      </tr><?php */?>
      
      
     <?php /*?> <tr>
        <th scope="row" valign="top"><label for="player">Song History:</label></th>
        
        <td>
        <input name="songhistory" type="checkbox" value="1" <?php if( $songhistory ) { ?> checked="checked" <?php } ?> />  (Only Shoutcast)
        </td>
      </tr><?php */?>
      
      
       <tr>
        <th scope="row" valign="top"><label for="player">Skin:</label></th>
        
        <td>
        
        <?php 
		
		//$skin = array ( ' ' => '==Official Skins==', 'mcclean' => 'McClean (180x60)', 'radiovoz' => 'RadioVoz (220x69)', 'faredirfare' => 'Faredirfare (269x52)', 'tweety' => 'Tweety (189x62)', 'compact' => 'Compact (191x46)', 'cassette' => 'Tim Simz - Cassette (200x120)', 'repvku-100' => 'Repvku-100 (100x25)', 'darkconsole' => 'DarkConsole (190x62)', 'tiny' => 'Tiny (130x60)', 'original' => 'Original (329x21)', 'eastanbul' => 'Eastanbul (467x26)', 'substream' => 'Substream (180x30)', 'easyplay' => 'EasyPlay (231x30)', 'stockblue' => 'Stockblue (476x26)', 'simple-blue' => 'Simple Blue [M] (300x122)', 'simple-gray' => 'Simple Gray [M] (300x122)', 'simple-green' => 'Simple Green [M] (300x122)', 'simple-orange' => 'Simple Orange [M] (300x122)', 'simple-red' => 'Simple Red [M] (300x122)', 'simple-violet' => 'Simple Violet [M] (300x122)', '  ' => '==Community Skins==', 'scradio' => 'SCRadio (160x100)', 'repvku-115' => 'Repvku-115 (115x25)', 'simcha-232-toggle' => 'Simcha-232 [T] (232x58)', 'simcha-232' => 'Simcha-232 (232x58)', 'simcha-320' => 'Simcha-320 (320x58)', 'appy' => 'Appy [T] (250x213)', 'blueberry' => 'Blueberry (338x102)', 'oldradio' => 'OldRadio (205x132)', 'oldstereo' => 'OldStereo (318x130)', 'xm' => 'Xm (234x66)', 'neon' => 'Neon (240x76)', 'neonslim' => 'NeonSlim (501x32)', 'greyslim' => 'GreySlim (494x35)', 'bogusblue' => 'BogusBlue (660x266)', 'bones' => 'Bones (341x125)', 'combat' => 'Combat (675x247)', 'dragonblues' => 'DragonBlues (400x145)', 'lemon' => 'Lemon (410x60)', 'limed' => 'Limed (397x115)', 'longtail' => 'Longtail (498x61)', 'pinhead' => 'Pinhead (421x120)', 'retro' => 'Retro (669x259)', 'silvertune' => 'Silvertune (200x104)', 'testskin' => 'Test/Develop (189x61)', 'kplayer' => 'KPlayer (220x200)' );
		
		
		 //if(isset($prms->skin) && $prms->skin=="") $skn="mcclean"; else $skn = $prms->skin;
		 
		 //echo "SKN<".$prms->skin.">";
		
		?>
        
        
        <select id="skin" name="skin">
					<option value="" disabled="">==Official Skins==</option>
											<option value="mcclean">McClean (180x60)</option>
											<option value="radiovoz">RadioVoz (220x69)</option>
											<option value="faredirfare">Faredirfare (269x52)</option>
											<option value="tweety">Tweety (189x62)</option>
											<option value="compact">Compact (191x46)</option>
											<option value="cassette">Tim Simz - Cassette (200x120)</option>
											<option value="repvku-100">Repvku-100 (100x25)</option>
											<option value="darkconsole">DarkConsole (190x62)</option>
											<option value="tiny">Tiny (130x60)</option>
											<option value="original">Original (329x21)</option>
											<option value="arvyskin">Arvy Skin [M] (560x30)</option>
											<option value="eastanbul">Eastanbul (467x26)</option>
											<option value="substream">Substream (180x30)</option>
											<option value="banita">BANita (110x25)</option>
											<option value="listen-live">Listen Live (250x100)</option>
											<option value="easyplay">EasyPlay (231x30)</option>
											<option value="stockblue">Stockblue (476x26)</option>
											<option value="largebayfm">LargeBayFM (451x90)</option>
											<option value="simple-blue">Simple Blue [M] (300x122)</option>
											<option value="simple-gray">Simple Gray [M] (300x122)</option>
											<option value="simple-green">Simple Green [M] (300x122)</option>
											<option value="simple-orange">Simple Orange [M] (300x122)</option>
											<option value="simple-red">Simple Red [M] (300x122)</option>
											<option value="simple-violet">Simple Violet [M] (300x122)</option>
										<option value="" disabled="">==Community Skins==</option>
											<option value="scradio">SCRadio (160x100)</option>
											<option value="repvku-115">Repvku-115 (115x25)</option>
											<option value="tandem-115">Tandem-115 (115x25)</option>
											<option value="simcha-232-toggle">Simcha-232 [T] (232x58)</option>
											<option value="simcha-232">Simcha-232 (232x58)</option>
											<option value="simcha-320">Simcha-320 (320x58)</option>
											<option value="kplayer">KPlayer (220x200)</option>
											<option value="appy">Appy [T] (250x213)</option>
											<option value="blueberry">Blueberry (338x102)</option>
											<option value="oldradio">OldRadio (205x132)</option>
											<option value="oldstereo">OldStereo (318x130)</option>
											<option value="xm">Xm (234x66)</option>
											<option value="abrahadabra">Abrahadabra (100x141)</option>
											<option value="abrahadabra2">Abrahadabra 2 (100x141)</option>
											<option value="wmp">WMP (386x47)</option>
											<option value="radioport">Radioport (700x150)</option>
											<option value="alberto">Alberto (250x95)</option>
											<option value="ff">FF (288x68)</option>
											<option value="neon">Neon (240x76)</option>
											<option value="player-stm">Player STM (128x30)</option>
											<option value="neonslim">NeonSlim (501x32)</option>
											<option value="greyslim">GreySlim (494x35)</option>
											<option value="tatarradiosi">Tatar Radiosi (418x150)</option>
											<option value="redsradiosml">Reds Radio SML (500x158)</option>
											<option value="bogusblue">BogusBlue (660x266)</option>
											<option value="bones">Bones (341x125)</option>
											<option value="combat">Combat (675x247)</option>
											<option value="dragonblues">DragonBlues (400x145)</option>
											<option value="lemon">Lemon (410x60)</option>
											<option value="limed">Limed (397x115)</option>
											<option value="longtail">Longtail (498x61)</option>
											<option value="pinhead">Pinhead (421x120)</option>
											<option value="retro">Retro (669x259)</option>
											<option value="silvertune">Silvertune (200x104)</option>
											<option value="testskin">Test/Develop (189x61)</option>
									</select>
                                    
                                    <script language="javascript">
									
										jQuery(document).ready(function() {
										// executes when HTML-Document is loaded and DOM is ready
										//alert("document is ready");
										jQuery("#skin").val('<?php echo $prms->skin; ?>');
										});
									
									</script>
        
        <?php /*?><select id="skin" name="skin">
        
        <?php foreach($skin as $k=>$v) { ?>
        
        <option value="<?php echo trim($k); ?>" <?php  if(trim($k)=="")  { ?>disabled=""<?php } ?> <?php if($id==0) { ?>selected="selected"<?php } ?> <?php if($prms->skin==trim($k)) { ?>selected="selected"<?php } ?>><?php echo $v; ?></option>
        
					 
        <?php } ?>             
                     
		</select><?php */?>
        
        
        </td>
      </tr>
      
      
      
      <tr>
        <th scope="row" valign="top"><label for="player">Language:</label></th>
        
        <td>
      <select name="lang" id="lang">
					<option value="auto" <?php if($prms->lang=="auto") echo ' selected="selected"'; ?>>-Automatic-</option>
					<option value="hy" <?php if($prms->lang=="hy") echo ' selected="selected"'; ?>>Armenian</option>
					<option value="bg" <?php if($prms->lang=="bg") echo ' selected="selected"'; ?>>Bulgarian</option>
					<option value="hr" <?php if($prms->lang=="hr") echo ' selected="selected"'; ?>>Croatian</option>
					<option value="nl" <?php if($prms->lang=="nl") echo ' selected="selected"'; ?>>Dutch</option>
					<option value="en" <?php if($prms->lang=="en") echo ' selected="selected"'; ?>>English</option>
					<option value="fi" <?php if($prms->lang=="fi") echo ' selected="selected"'; ?>>Finnish</option>
					<option value="fr" <?php if($prms->lang=="fr") echo ' selected="selected"'; ?>>French</option>
					<option value="de" <?php if($prms->lang=="de") echo ' selected="selected"'; ?>>German</option>
					<option value="el" <?php if($prms->lang=="el") echo ' selected="selected"'; ?>>Greek</option>
					<option value="hu" <?php if($prms->lang=="hu") echo ' selected="selected"'; ?>>Hungarian</option>
					<option value="it" <?php if($prms->lang=="it") echo ' selected="selected"'; ?>>Italian</option>
					<option value="nb" <?php if($prms->lang=="nb") echo ' selected="selected"'; ?>>Norwegian</option>
					<option value="pl" <?php if($prms->lang=="pl") echo ' selected="selected"'; ?>>Polish</option>
					<option value="pt" <?php if($prms->lang=="pt") echo ' selected="selected"'; ?>>Portuguese</option>
					<option value="ru" <?php if($prms->lang=="ru") echo ' selected="selected"'; ?>>Russian</option>
					<option value="sl" <?php if($prms->lang=="sl") echo ' selected="selected"'; ?>>Slovene</option>
					<option value="es" <?php if($prms->lang=="es") echo ' selected="selected"'; ?>>Spanish</option>
					<option value="sv" <?php if($prms->lang=="sv") echo ' selected="selected"'; ?>>Swedish</option>
					<option value="tt" <?php if($prms->lang=="tt") echo ' selected="selected"'; ?>>Tatar</option>
					<option value="tr" <?php if($prms->lang=="tr") echo ' selected="selected"'; ?>>Turkish</option>
					<option value="uk" <?php if($prms->lang=="uk") echo ' selected="selected"'; ?>>Ukrainian</option>
				</select>
        </td>
       
        </tr>
        
      
      
      
      
       <tr>
        <th scope="row" valign="top"><label for="player">Buffering Time:</label></th>
        
        <td>
        <input name="buffering" id="buffering" style="width:30px" maxlength="2" type="text" class="regular-text" value="<?php if($prms->buffering=="") echo "5"; else echo $prms->buffering; ?>" />&nbsp;secs.
        </td>
        </tr>
      
          <tr>
        <th scope="row" valign="top"><label for="player">Volume Level:</label></th>
        
        <td>
        
        <?php $volume = $prms->volume; if($volume=="") $volume=60; ?>
        
        <select name="volume" id="volume"> 
        
        <?php for($v=1;$v<=10;$v++) { ?>
        
        <option value="<?php echo $v*10; ?>" <?php if($volume==$v*10) echo ' selected="selected"'; ?>><?php echo $v*10; ?></option>
        
        <?php } ?>
        
        </select>&nbsp;%
        
        
        </td>
      </tr>
      
      
      
      
      
      
      
<?php /*?>       <tr>
        <th scope="row" valign="top"><label for="player">Player Artwork:</label></th>
        
        <td>
        <input name="image" type="text" class="regular-text" value="<?php echo $image; ?>" />
        </td>
      </tr><?php */?>
      
      

      
      
      
      
       <tr>
        <th scope="row" valign="top"><label for="player">Player Width:</label></th>
        
        <td>
        <input name="width" id="width" type="text" style="width:40px" maxlength="3" class="regular-text" value="<?php if($prms->width=="") echo "220"; else echo $prms->width; ?>" />&nbsp;px
        </td>
      </tr>
      
      
      
       <tr>
        <th scope="row" valign="top"><label for="player">Player Height:</label></th>
        
        <td>
        <input name="height" id="height" type="text" style="width:40px" maxlength="3" class="regular-text" value="<?php if($prms->height=="") echo "200"; else echo $prms->height; ?>" />&nbsp;px
        </td>
      </tr>
      
      

      
      
<?php /*?>      <tr>
        <th scope="row" valign="top"><label for="player">Player Background Image:</label></th>
        
        <td>
        <input name="bgimage" id="bgimage" type="text" class="regular-text" value="<?php echo $prms->bgimage; ?>" />
        </td>
      </tr><?php */?>
      
      
      
      <tr>
        <th scope="row" valign="top"><label for="player">Radio Title:</label></th>
        
        <td>
        <input name="title" id="title" type="text" class="regular-text" value="<?php echo $prms->title; ?>" />
        </td>
      </tr>
      
      <tr>
        <th scope="row" valign="top"><label for="player">Radio Artist:</label></th>
        
        <td>
        <input name="artist" id="artist" type="text" class="regular-text" value="<?php echo $prms->artist; ?>" />
        </td>
      </tr>
      
      
      
       <?php /*?><tr>
        <th scope="row" valign="top"><label for="player">Facebook Link:</label></th>
        
        <td>
        <input name="facebook" type="text" class="regular-text" value="<?php echo $prms->facebook; ?>" />
        </td>
      </tr>
      
       <tr>
        <th scope="row" valign="top"><label for="player">Twitter Link:</label></th>
        
        <td>
        <input name="twitter" type="text" class="regular-text" value="<?php echo $prms->twitter; ?>" />
        
        
        
        </td>
      </tr><?php */?>
      
      
<?php /*?>       <tr>
        <th scope="row" valign="top"><label for="player">Google+ Link:</label></th>
        
        <td>
        <input name="gplus" type="text" class="regular-text" value="<?php echo $prms->gplus; ?>" />
        
       
        
        </td>
      </tr><?php */?>
      
      
<?php /*?>            <tr>
        <th scope="row" valign="top"><label for="player">Custom HTML:</label></th>
        
        <td>
        <textarea cols="60" rows="10" name="html" style="border:1px dotted #343434" ><?php echo $prms->html; ?></textarea> 
        
        </td>
      </tr><?php */?>
      
      

    </table>
    <br/>
    <span class="submit" style="border: 0;">
    
     <input type="hidden" name="id" value="<?php echo $id; ?>" />
     
    <input  type="button" name="submit" onclick="generatePlayerCode();" value="Generate Player Code" />
    </span>
 

</form>


<script type="text/javascript">
  
  function generatePlayerCode()
  {
  
    //alert("sv");
	
	var url = document.getElementById("url").value;
	var codec = document.getElementById("codec").value;
	var radiotype = document.getElementById("radiotype").value;
	var introurl =  document.getElementById("introurl").value;
	var welcome =  document.getElementById("welcome").value;
	var autoplay =  document.getElementById("autoplay").value;
	var skin =  document.getElementById("skin").value;
	var lang =  document.getElementById("lang").value;
	var buffering =  document.getElementById("buffering").value;
	var volume =  document.getElementById("volume").value;
	var width =  document.getElementById("width").value;
	var height =  document.getElementById("height").value;
	
	//var bgimage = document.getElementById("bgimage").value;
	var title = document.getElementById("title").value;
	var artist = document.getElementById("artist").value;
	
	
	url = url.trim();
	//image = image.trim();
	//facebook = facebook.trim();
	//twitter = twitter.trim();
	
	if(radiotype=="shoutcast1") url = url+";";
	
	if(skin=="") skin = "kplayer";
	
	if(radiotype=="shoutcast1") radiotype = "shoutcast";
	if(radiotype=="shoutcast2") radiotype = "shoutcast";  
	
	
	//document.getElementById("shortcode").innerHTML = '[html5radio radiolink="'+radiolink+'" radiotype="'+radiotype+'" bcolor="'+bcolor+'" image="'+image+'" title="'+title+'" artist="'+artist+'" facebook="'+facebook+'" twitter="'+twitter+'"]';
	
	
	//document.getElementById("iframe").innerHTML = '<iframe src="http://player.radioforge.com/v2/'+radiotype+'.html?radiolink='+radiolink+'&radiotype='+radiotype+'&bcolor='+bcolor+'&image='+image+'&facebook='+facebook+'&twitter='+twitter+'&title='+title+'&artist='+artist+'" frameborder="0" marginheight="0" marginwidth="0" scrolling="no" width="367" height="227"></iframe>';


    var strHTML = '<textarea cols="60" rows="10" onFocus="this.select();" style="border:1px dotted #343434">';

    strHTML +=  '[radioforge url="'+url+'" skin="'+skin+'" codec="'+codec+'" radiotype="'+radiotype+'" introurl="'+introurl+'" welcome="'+welcome+'" autoplay="'+autoplay+'" lang="'+lang+'" buffering="'+buffering+'" volume="'+volume+'" width="'+width+'" height="'+height+'" title="'+title+'" artist="'+artist+'"]'; 
	 
	//strHTML += "&lt;script type='text/javascript'>";
    //strHTML += "MRP.insert({'url':'"+url+"','lang':'"+lang+"','codec':'"+codec+"','volume':"+volume+",'introurl':'"+introurl+"','fallback':'"+introurl+"','autoplay':"+autoplay+",'jsevents':false,'buffering':"+buffering+",'title':'"+title+"','welcome':'"+welcome+"','bgcolor':'#FFFFFF','wmode':'transparent','skin':'"+skin+"','width':"+width+",'height':"+height+"});&lt;/script&gt;";
	
	//strHTML += '<a target="blank" href="https://www.radioforge.com/">RadioForge.com</a>';
	
    strHTML += '</textarea>'; 

    //alert(strHTML);	
	
 
	
	
	document.getElementById("embed").innerHTML = strHTML;
	
	//document.getElementById("iframe").innerHTML = strHTML1;
	
	
	//document.getElementById("embed").select();
	

  
  }
  
  </script>

<br />

<?php //if($id!=0) { 

if($id=="") {
?>

<?php /*?><h3>Shortcode for Page or Post</h3>

<code>

[radioforge id=<?php echo $id; ?>]

</code><br /><br /><?php */?>

 


<hr />

<h3>Embed in Page or Post</h3>

<?php 

if($prms->radiotype=="shoutcast1")
{
  $radiourl = $prms->url.";";
  
}
else
{
  $radiourl = $prms->url;
} 


if($prms->autoplay=="true")
  $autoplay="true";
else
  $autoplay="false";  

ob_start();

?>

<div align="center" id="radioforge<?php echo $id; ?>" style="background:url(<?php echo $prms->bgimage; ?>) no-repeat; width:<?php echo $prms->width; ?>px; height:<?php echo $prms->height; ?>px;">
<?php echo '<scr'; echo 'ipt type="text/javascr'; echo 'ipt" src="https://hosted.muses.org/mrp.js">'; echo '</scr'; echo 'ipt>'; ?>
<?php echo '<scr'; echo 'ipt type="text/javascr'; echo 'ipt">'; ?>
MRP.insert({
'url':'<?php echo $radiourl; ?>',
'lang':'<?php echo $prms->lang; ?>',
'codec':'<?php echo $prms->codec; ?>',
'volume':<?php echo $prms->volume; ?>,
'introurl':'<?php echo $prms->introurl; ?>',
'fallback':'<?php echo $prms->introurl; ?>',
'autoplay':<?php echo $autoplay; ?>,
'jsevents':false,
'buffering':<?php echo $prms->buffering; ?>,
'title':'<?php echo $prms->title; ?> - <?php echo $prms->artist; ?>',
'welcome':'<?php echo $prms->welcome; ?>',
'bgcolor':'#FFFFFF',
'wmode':'transparent',
'skin':'<?php echo $prms->skin; ?>',
'width':<?php echo $prms->width; ?>,
'height':<?php echo $prms->height; ?>
});
<?php echo '</scr'; echo 'ipt>'; ?>

<div style="float:right; padding-right:3px; z-index:2000; overflow:auto; position:absolute;"><?php if($prms->twitter!=""){ ?><a href="<?php echo $prms->twitter;?>" target="_blank" title="Twitter"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>/images/twitter.png" border="0" width="18" height="18" /></a><?php } ?><?php if($prms->facebook!=""){ ?><a href="<?php echo $prms->facebook;?>" target="_blank"  title="Facebook"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>/images/facebook.png" border="0" width="18" height="18" /></a><?php } ?><?php if($prms->gplus!=""){ ?><a href="<?php echo $prms->gplus;?>" target="_blank" title="Google+"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>/images/google-plus.png" border="0" width="18" height="18" /></a><?php } ?></div></div>

<?php

$iframe = ob_get_contents();
ob_end_clean();


?>
<br />

<?php //echo $iframe; ?><br />

<br />

<span id="embed">
 <!-- Embed Here --> 
</span>

&nbsp;<?php } ?>


  <div>
        		
 </div>
 
<strong>This plugin uses <a href="http://www.muses.org/" target="_blank">Muses Radio Player</a>, under GNU/GPL license.</strong>

<?php /*?><script language="javascript" type="text/javascript">

document.onload = function() {

var givenValue = '<?php echo $prms->skin; ?>';

var dropdownlistbox1 = document.getElementById("skin")
 
for(var x=0;x < dropdownlistbox1.length -1 ; x++)
{
   if(givenValue == dropdownlistbox1.options[x].text)
 
      dropdownlistbox1.selectedIndex = x;
}

var givenValue = '<?php echo $prms->lang; ?>';

var dropdownlistbox2 = document.getElementById("lang")
 
for(var x=0;x < dropdownlistbox2.length -1 ; x++)
{
   if(givenValue == dropdownlistbox2.options[x].text)
 
      dropdownlistbox2.selectedIndex = x;
}

}

</script><?php */?>
