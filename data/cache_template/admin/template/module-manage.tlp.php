<?php !defined('IN_MANAGE') && exit('Access Denied!');use phpWeChat\Form;use phpWeChat\Module;use phpWeChat\MySql;?>

<!doctype html>

<html>

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>phpWeChat后台管理</title>

    <link rel="stylesheet" type="text/css" href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>admin/template/css/common.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>admin/template/css/main.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/core.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/reveal/reveal.css"/>
	
	<script language="javascript" type="text/javascript">

		var PW_PATH='<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>';

	</script>
	
	<script src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/jquery/jquery-1.12.2.min.js" language="javascript"></script>
	
	<script type="text/javascript" src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/ZeroClipboard/ZeroClipboard.js"></script> 

    <script src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/reveal/jquery.reveal.js" language="javascript"></script>

	<script src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/core.js" language="javascript"></script>

    <script type="text/javascript" src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>admin/template/js/libs/modernizr.min.js"></script>

    

</head>

<body>

<div class="ifame-main-wrap">

      <div class="crumb-wrap">

          <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?file=index&action=main">管理首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">模块管理</span></div>

      </div>

      <div class="result-wrap">

          <form name="myform" id="myform" action="" method="post">

              <input type="hidden" value="delete" name="job" id="job">

              <div class="result-title">

                  <div class="result-list">

                      <a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=&file=<?php echo isset($file)?$file:'';?>&action=diy"><i class="icon-font">&#xe002;</i>自定义模块</a>

                      <a href="###" onClick="if(isCheckboxChecked()){$('#job').val('setoderby');$('#myform').submit();}else{alert('请选择要'+$(this).text()+' 的项目！')}"><i class="icon-font">&#xe062;</i>更新排序</a>

                      <a href="###" onClick="if(isCheckboxChecked()){$('#job').val('setundisabled');$('#myform').submit();}else{alert('请选择要'+$(this).text()+' 的项目！')}"><i class="icon-font">&#xe068;</i>批量启用</a>

                      <a href="###" onClick="if(isCheckboxChecked()){$('#job').val('setdisabled');$('#myform').submit();}else{alert('请选择要'+$(this).text()+' 的项目！')}"><i class="icon-font">&#xe069;</i>批量禁用</a>

                      <?php if($parentkey) { ?><a href="###" onClick="if(!confirm('确定要卸载此模块吗？')){return false;}else{if(isCheckboxChecked()){$('#job').val('uninstall');$('#myform').submit();}else{alert('请选择要'+$(this).text()+' 的项目！')}}"><i class="icon-font">&#xe061;</i>批量卸载模块</a><?php }?>

                  </div>

              </div>

              <div class="result-content">

                  <table class="result-tab" width="100%">

                      <tr>

                          <th class="tc" width="5%"><input id="checkAll" class="common-checkbox" title="全选/反选" type="checkbox"></th>

                          <th width="15%">Key</th>

                          <th width="5%">排序</th>

                          <th width="11%">名称</th>

                          <th width="24%">路径</th>

                          <th width="10%">父模块</th>

                          <th width="5%">状态</th>

                          <th width="30%">操作</th>

                      </tr>

                      <?php $no=1;if(is_array(Module::moduleList($parentkey)))foreach(Module::moduleList($parentkey) as $r){?>

                      <?php if($r['folder']) { ?>

                      <tr>

                          <td class="tc"><input name="keys[<?php echo isset($r['key'])?$r['key']:'';?>]" la="checkbox" class="common-checkbox" value="<?php echo isset($r['key'])?$r['key']:'';?>" type="checkbox"></td>

                          <td><?php echo strtoupper($r['key']);?></td>

                          <td title="<?php echo isset($r['orderby'])?$r['orderby']:'';?>"><input class="common-text" size="2" style="text-align:center" value="<?php echo isset($r['orderby'])?$r['orderby']:'';?>" name="orderbys[<?php echo isset($r['key'])?$r['key']:'';?>]"></td>

                          <td style="line-height:2em"><?php echo isset($r['name'])?$r['name']:'';?>
						  <?php if($parentkey) { ?><br><font style="font-size:12px"><?php echo Module::version($r['key']);?></font><?php }?>
						  </td>

						  

                          <td style="font-size:12px"><?php echo ($parentkey?'/addons/'.Module::getModuleByKey($parentkey,'folder').'/addons/':'/addons/').$r['folder'];?></td>

                          <td><?php echo $r['parentkey']?Module::getModuleByKey($r['parentkey'],'name'):'一级模块';?></td>

                          <td><?php echo $r['disabled']?'<font style="color:#ff3300">已禁用</font>':'<font style="color:#44b549">正常</font>';?></td>

                          <td>

                          	  <?php if(!$parentkey) { ?><a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=&file=<?php echo isset($file)?$file:'';?>&action=<?php echo isset($action)?$action:'';?>&parentkey=<?php echo isset($r['key'])?$r['key']:'';?>">管理子模块 [<span style="font-weight:bold; color:#FF3300"><?php echo Module::getChindrenCounts($r['key']);?></span>]</a>

                              &nbsp;&nbsp;&nbsp;

							  <?php }else{ ?>
							  <a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=&file=<?php echo isset($file)?$file:'';?>&action=set&modulekey=<?php echo isset($r['key'])?$r['key']:'';?>">配置</a>

							   &nbsp;|&nbsp;
 							  <a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=&file=<?php echo isset($file)?$file:'';?>&action=tables&modulekey=<?php echo isset($r['key'])?$r['key']:'';?>">关联数据表</a>

							   &nbsp;|&nbsp;

							  <a onClick="if(!confirm('确定要导出此模块吗？')){return false;}" href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=&file=<?php echo isset($file)?$file:'';?>&action=export&modulekey=<?php echo isset($r['key'])?$r['key']:'';?>">导出</a>
                 &nbsp;|&nbsp;

							  <a onClick="if(!confirm('确定要卸载此模块吗？')){return false;}" href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=&file=<?php echo isset($file)?$file:'';?>&action=<?php echo isset($action)?$action:'';?>&job=uninstall&keys=<?php echo isset($r['key'])?$r['key']:'';?>">卸载</a>
				&nbsp;|&nbsp;

							  <a href="http://s.phpwechat.com/index.php?action=patch&domain=<?php echo urlencode(get_server_name());?>&module=<?php echo isset($r['key'])?$r['key']:'';?>&version=<?php echo strtolower(Module::version($r['key']));?>" target="_blank" >补丁包</a>
							<br>
							<input type="hidden"  value="<?php echo format_url(U($r['folder']));?>" id="fe_text_<?php echo isset($r['folder'])?$r['folder']:'';?>">
							<a href="#" id="clip_<?php echo isset($r['folder'])?$r['folder']:'';?>">复制模块链接URL</a>
							<script language="javascript" type="text/javascript"> 
									var clip<?php echo isset($r['folder'])?$r['folder']:'';?> = new ZeroClipboard.Client(); // 新建一个对象 
									clip<?php echo isset($r['folder'])?$r['folder']:'';?>.setHandCursor( true ); // 设置鼠标为手型 
									clip<?php echo isset($r['folder'])?$r['folder']:'';?>.setText($('#fe_text_<?php echo isset($r['folder'])?$r['folder']:'';?>').val()); // 设置要复制的文本。 
									// 注册一个 button，参数为 id。点击这个 button 就会复制。 
									//这个 button 不一定要求是一个 input 按钮，也可以是其他 DOM 元素。 
									clip<?php echo isset($r['folder'])?$r['folder']:'';?>.glue("clip_<?php echo isset($r['folder'])?$r['folder']:'';?>"); // 和上一句位置不可调换 
									clip<?php echo isset($r['folder'])?$r['folder']:'';?>.addEventListener( "complete", function(){ 
									alert("模块URL复制成功，您可以直接粘贴到自定义菜单或者其他地方！"); 
									}); 
							</script> 
                               <?php }?>

                          </td>

                      </tr>

                     <?php }?>

                     <?php $no++;}?>

                  </table>

              </div>

          </form>

      </div>

  </div>

    <div class="statics-footer"> Powered by phpWeChat V<?php echo defined('PHPWECHAT_VERSION')?PHPWECHAT_VERSION:'{__PHPWECHAT_VERSION__}';?><?php echo defined('PHPWECHAT_RELEASE')?PHPWECHAT_RELEASE:'{__PHPWECHAT_RELEASE__}';?> © , Processed in <?php echo microtime()-$PW['time_start'];?> second(s) , <?php echo MySql::$mQuery;?> queries <a href="#">至顶端↑</a></div>

</body>

</html>