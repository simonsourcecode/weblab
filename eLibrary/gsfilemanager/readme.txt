需要修改GSFileManager.php文件中这一行，来指定文件管理树的根目录就OK了--simon
“ $options[GSFileManager::$root_param] = 'C:/jtreefs';”

Free software ready to be used in your project. It is web based jQuery AJAX driven, multi language ready web application for storing, editing and managing files and folders online via web browser. The Application which looks like desktop ones currently has a PHP server side implementation, a build-in support for managing text files with ckeditor and a build-in support for resizing and cropping online pictures with JCrop. It uses abeautifulsite jQuery context-menu plugin for context menu and jQuery Form Plugin for ajax submiting forms. 
 
If you just want to store your files online you can register and use service for free 
 
You can see it in action here and yo can use it for absolutely free in your projects, it has no biuld-in authorization support so it is your decision who has rigths for what. The PHP code is written in OOP standarts so with few lines you can get it working. In example code basic configuration is located in demo/connectors/GsFileManager.php file. The root folder for the file manager must be configured with absolute path WITHOUT slash at the end. 	 $options = array();
	 $options[GSFileManager::$root_param] = 'C:/jtreefs'; //只需要修改这里
	 $options['max_upload_filesize'] = '2000'; //(the size in Kbytes)
	 $manager = new GSFileManager(new GSFileSystemFileStorage(), $options);
	 try {
		$result = $manager->process($_REQUEST);
	 } catch (Exception $e) {
		$result = '{result: \'0\', gserror: \''.addslashes($e->getMessage()).'\', code: \''.$e->getCode().'\'}';
	 }
	 echo $result;
 
The zip and gd php extensins must be loaded. The GSFileSystemFileStorage class is an implementation of access to file system so with custom implementation the files can be on remote file system or every where you want. The actual full path to files and folders is not exposed to end user and they can not be called directly in browser. 
 
The client side code is even easier 	<script src="jquery.min.js" type="text/javascript"></script>
	<script src="jquery-ui-min.js" type="text/javascript"></script>
	<script src="gsFileManager.js" type="text/javascript"></script>
	<script src="jquery.form.js" type="text/javascript"></script>
	//If you want jcrop support
	<script src="jquery.Jcrop.js" type="text/javascript"></script>
	//If you want ckeditor support
	<script src="lib/ckeditor/ckeditor.js" type="text/javascript"></script>
	
	<link href="gsFileManager.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="jquery.Jcrop.css" rel="stylesheet" type="text/css" media="screen" />
		
	<script type="text/javascript">
			
	jQuery(document).ready( function() {
				
		jQuery('#gsfiledemo').gsFileManager({ script: 'connectors/GsFileManager.php});
				
	});
	</script>
		
	<div id="gsfiledemo"></div>
 
And now you have a web file manager with root dir C:/jtreefs/$username/. Currently Web File manager is available only in English but it can be translated very easy all Strings are encapsulated in array, all you have to do is to create an js array in gsFileManager.js for your language and to pass desired language as parameter when creating a jQuery file manager instance     jQuery('#gsfiledemo').gsFileManager({ script: 'connectors/GsFileManager.php, language: 'en'});
 
