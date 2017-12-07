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
          <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?file=index&action=main">管理首页</a><span class="crumb-step">&gt;</span><span class="crumb-name"><a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=<?php echo isset($mod)?$mod:'';?>&file=<?php echo isset($file)?$file:'';?>&action=<?php echo isset($action)?$action:'';?>">粉丝营销</a></span></div>
      </div>
      <div class="result-wrap">
          <form name="myform" id="myform" action="" method="post">
              <input type="hidden" value="delete" name="job" id="job">
              <div class="result-title">
                  <div class="result-list">
				  	  <a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=<?php echo isset($mod)?$mod:'';?>&file=<?php echo isset($file)?$file:'';?>&action=load_fans"><i class="icon-font">&#xe010;</i>同步微信粉丝用户</a>
					  &nbsp;&nbsp;&nbsp;
                      <a href="###" onClick="if(isCheckboxChecked()){$('#job').val('refresh');$('#myform').submit();}else{alert('请选择要'+$(this).text()+' 的项目！')}"><i class="icon-font">&#xe045;</i>刷新粉丝信息</a>
					  &nbsp;&nbsp;&nbsp;
					  <a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=<?php echo isset($mod)?$mod:'';?>&file=<?php echo isset($file)?$file:'';?>&action=groups"><i class="icon-font">&#xe062;</i>用户分组管理</a>
					  &nbsp;&nbsp;&nbsp;
					  <a href="###" onClick="if(isCheckboxChecked()){$('#job').val('setgroup');$('#myform').submit();}else{alert('请选择要'+$(this).text()+' 的项目！')}"><i class="icon-font">&#xe035;</i>转移分组至</a>
					  <select name="gotogroupid">
					  	<?php $no=1;if(is_array(WeChatManage::groupLimitList()))foreach(WeChatManage::groupLimitList() as $r){?>
					  	<option value="<?php echo isset($r['id'])?$r['id']:'';?>"><?php echo isset($r['name'])?$r['name']:'';?></option>
						<?php $no++;}?>
					  </select>
                  </div>
              </div>
              <div class="result-content">
                  <table class="result-tab" width="100%">
                      <tr>
                        <th class="tc" width="1%"><input id="checkAll" class="common-checkbox" checked="checked" title="全选/反选" type="checkbox"></th>
                          <th width="3%">编号</th>
                          <th width="14%">粉丝昵称</th>
						  <th width="9%">性别</th>
						  <th width="14%">分组名</th>
						  <th width="12%">省(直辖市)</th>
						  <th width="13%">城市</th>
						  <th width="13%">头像</th>
						  <th width="13%">是否关注</th>
                          <th width="8%">操作</th>
                      </tr>
                      <?php $no=1;if(is_array($data))foreach($data as $r){?>
                      <tr>
                          <td class="tc"><input name="ids[<?php echo isset($r['id'])?$r['id']:'';?>]" class="common-checkbox" checked="checked" la="checkbox" value="<?php echo isset($r['id'])?$r['id']:'';?>" type="checkbox"></td>
                          <td><?php echo isset($r['id'])?$r['id']:'';?></td>
                          <td><?php if($r['nickname']) { ?><?php echo isset($r['nickname'])?$r['nickname']:'';?><?php }else{ ?>-<?php }?></td>
						  <td><?php echo $r['sex']==1?'男':($r['sex']==2?'女':'未知');?></td>
						  <td><a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=wechat&file=core&action=ucenter&groupid=<?php echo isset($r['groupid'])?$r['groupid']:'';?>"><?php if($r['groupid']) { ?><?php echo WeChatManage::getGroup($r['groupid'],'name');?><?php }else{ ?>未分组<?php }?></a></td>
						  <td><?php if($r['province']) { ?><?php echo isset($r['province'])?$r['province']:'';?><?php }else{ ?>-<?php }?></td>
						  <td><?php if($r['city']) { ?><?php echo isset($r['city'])?$r['city']:'';?><?php }else{ ?>-<?php }?></td>
						  <td><?php if($r['headimgurl']) { ?><a href="<?php echo isset($r['headimgurl'])?$r['headimgurl']:'';?>" target="_blank"><img src="<?php echo isset($r['headimgurl'])?$r['headimgurl']:'';?>" style="width:50px; margin:8px 0px" /></a><?php }else{ ?>-<?php }?></td>
						  <td style="line-height:22px;"><?php if($r['issubscribe']) { ?><font style="color:#339933">已关注</font><br><font style="font-size:12px; color:#666666"><?php echo date('Y-m-d H:i:s',$r['subscribetime']);?></font><?php }else{ ?><font style="color:#FF3300">未关注</font><?php }?></td>
                          <td>
                          	  <a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=<?php echo isset($mod)?$mod:'';?>&file=<?php echo isset($file)?$file:'';?>&action=fans_action&openid=<?php echo isset($r['openid'])?$r['openid']:'';?>">粉丝行为管理</a>
                          </td>
                      </tr>
                     <?php $no++;}?>
                     <tr>
                     	<td colspan="10">
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