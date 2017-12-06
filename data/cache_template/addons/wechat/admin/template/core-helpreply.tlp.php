<?php !defined('IN_MANAGE') && exit('Access Denied!');use Wechat\WeChatManage;use Wechat\Wechat;use phpWeChat\Form;use phpWeChat\MySql;?>

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

	<script src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/jquery/jquery-1.12.2.min.js" language="javascript"></script>

    <script src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/reveal/jquery.reveal.js" language="javascript"></script>

	<script src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/core.js" language="javascript"></script>

    <script type="text/javascript" src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>admin/template/js/libs/modernizr.min.js"></script>

    <script language="javascript" type="text/javascript">

		var PW_PATH='<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>';

	</script>

</head>

<body>

<div class="ifame-main-wrap">

      <div class="crumb-wrap">

          <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?file=index&action=main">管理首页</a><span class="crumb-step">&gt;</span><span class="crumb-name"><a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=<?php echo isset($mod)?$mod:'';?>&file=<?php echo isset($file)?$file:'';?>&action=<?php echo isset($action)?$action:'';?>">部门管理</a></span></div>

      </div>

      <div class="result-wrap">

          <form name="myform" id="myform" action="" method="post">

              <input type="hidden" value="delete" name="job" id="job">

              <div class="admin-nav">

                <h2>自动回复</h2>

                <div class="nav">

                    <a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=wechat&file=core&action=subscribereply">被关注自动回复</a>

                    <a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=wechat&file=core&action=autoreply">消息自动回复</a>

                    <a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=wechat&file=core&action=helpreply" class="hover">关键词自动回复</a>

                </div>

                <div class="admin-tips">

                    关键词自动回复是指当有用户在回复框输入内容含有指定关键词时，公众号自动回复内容。

                </div>

              </div>

              <div class="result-title">

                  <div class="result-list">

                      <a href="###" onClick="if(isCheckboxChecked()){$('#job').val('delete');$('#myform').submit();}else{alert('请选择要'+$(this).text()+' 的项目！')}"><i class="icon-font">&#xe037;</i>批量删除</a>

                      <a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=wechat&file=core&action=helpreply_add"><i class="icon-font">&#xe002;</i>添加关键词自动回复</a>

                  </div>

              </div>

              <div class="result-content">

                  <table class="result-tab" width="100%">

                      <tr>

                        <th class="tc" width="2%"><input id="checkAll" class="common-checkbox" checked="checked" title="全选/反选" type="checkbox"></th>

                        <th width="4%">ID</th>

                        <th width="22%">关键词</th>

					    <th width="10%">匹配类型</th>

                        <th width="10%">消息类型</th>

                          <th width="46%">内容</th>

					    <th width="6%">管理</th>

                    </tr>

                      <?php $no=1;if(is_array($data))foreach($data as $r){?>

                      <tr>

                          <td class="tc"><input name="ids[<?php echo isset($r['id'])?$r['id']:'';?>]" class="common-checkbox" checked="checked" la="checkbox" value="<?php echo isset($r['id'])?$r['id']:'';?>" type="checkbox"></td>

                          <td><?php echo isset($r['id'])?$r['id']:'';?></td>

                          <td><?php echo isset($r['keyword'])?$r['keyword']:'';?></td>

						  <td><?php if($r['keyword_type']==1) { ?>精确匹配<?php }else{ ?>模糊匹配<?php }?></td>

						  <td><?php echo isset($type[$r['material_type']])?$type[$r['material_type']]:'';?></td>

                          <td>

                          <?php if($r['material_type']=='text') { ?>

                          <?php echo isset($r['content'])?$r['content']:'';?>

                          <?php }elseif($r['material_type']=='image'){ ?>

                          <?php $info=WeChatManage::getImageMaterialByMediaId($r['media_id']);?>

                          <div  style="padding:0px; position:relative; width:160px; margin:8px auto; overflow:hidden; height:160px;">

                              <img src="<?php echo isset($info['local_url'])?$info['local_url']:'';?>" style="width:160px; height:160px;" />

                              <span style="background:#000; color:#FFFFFF; padding:0px 5px; width:100%; position:absolute; bottom:0px; left:0px;filter:alpha(opacity=50); -moz-opacity:0.50; opacity:0.50;"><?php echo sub_string($info['name'],20,'...');?></span>

                          </div>

                          <?php }elseif($r['material_type']=='media'){ ?>

                          <?php $info=WeChatManage::getMaterialByMediaId($r['media_id']);?>

                          <div  style="padding:0px; position:relative; width:160px; margin:8px auto; overflow:hidden; height:160px;">

                              <img src="<?php echo isset($info['PicUrl'])?$info['PicUrl']:'';?>" style="width:160px; height:160px;" />

                              <span style="background:#000; color:#FFFFFF; padding:0px 5px; width:100%;position:absolute; bottom:0px; left:0px;filter:alpha(opacity=50); -moz-opacity:0.50; opacity:0.50;"><?php echo sub_string($info['Title'],20,'...');?></span>

                          </div>

                          <?php }elseif($r['material_type']=='voice'){ ?>

                          <?php $info=WeChatManage::getVoiceMaterialByMediaId($r['media_id']);?>

                          语音：<a href="<?php echo isset($info['local_url'])?$info['local_url']:'';?>" target="_blank"><?php echo isset($info['name'])?$info['name']:'';?></a>

                          <?php }elseif($r['material_type']=='video'){ ?>

                          <?php $info=WeChatManage::getVideoMaterialByMediaId($r['media_id']);?>

                          视频：<a href="<?php echo isset($info['remote_url'])?$info['remote_url']:'';?>" target="_blank"><?php echo isset($info['name'])?$info['name']:'';?></a>

                          <?php }?>

                          </td>

                          <td>

                              <a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=<?php echo isset($mod)?$mod:'';?>&file=<?php echo isset($file)?$file:'';?>&action=<?php echo isset($action)?$action:'';?>&job=delete&ids=<?php echo isset($r['id'])?$r['id']:'';?>">删除</a>

                          </td>

                      </tr>

                     <?php $no++;}?>

                     <tr>

                     	<td colspan="7">

                        	<?php echo WeChatManage::$mPageString;?>

                        </td>

                     </tr>

                  </table>

              </div>

          </form>

      </div>

  </div>

    <div class="statics-footer"> Powered by phpWeChat V<?php echo defined('PHPWECHAT_VERSION')?PHPWECHAT_VERSION:'{__PHPWECHAT_VERSION__}';?><?php echo defined('PHPWECHAT_RELEASE')?PHPWECHAT_RELEASE:'{__PHPWECHAT_RELEASE__}';?> © , Processed in <?php echo microtime()-$PW['time_start'];?> second(s) , <?php echo MySql::$mQuery;?> queries <a href="#">至顶端↑</a></div>

</body>

</html>