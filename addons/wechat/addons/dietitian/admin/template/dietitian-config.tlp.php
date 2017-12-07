{php !defined('IN_MANAGE') && exit('Access Denied!');}
<?php
use wechat\Dietitian\Dietitian;
use phpWeChat\Area;
use phpWeChat\CaChe;
use phpWeChat\Config;
use phpWeChat\Member;
use phpWeChat\Module;
use phpWeChat\MySql;
use phpWeChat\Order;
use phpWeChat\Upload;
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>phpWeChat后台管理</title>
    <link rel="stylesheet" type="text/css" href="{__PW_PATH__}admin/template/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="{__PW_PATH__}admin/template/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="{__PW_PATH__}statics/core.css"/>
    <link rel="stylesheet" type="text/css" href="{__PW_PATH__}statics/reveal/reveal.css"/>
	<script language="javascript" type="text/javascript">
		var PW_PATH='{__PW_PATH__}';
	</script>
	<script src="{__PW_PATH__}statics/jquery/jquery-1.12.2.min.js" language="javascript"></script>
    <script src="{__PW_PATH__}statics/reveal/jquery.reveal.js" language="javascript"></script>
	<script src="{__PW_PATH__}statics/core.js" language="javascript"></script>
    <script type="text/javascript" src="{__PW_PATH__}admin/template/js/libs/modernizr.min.js"></script>
    
</head>
<body>
    <div class="ifame-main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="{__PW_PATH__}{__ADMIN_FILE__}?file=index&action=main">管理首页</a><span class="crumb-step">&gt;</span><span class="crumb-name"><a href="{__PW_PATH__}{__ADMIN_FILE__}?mod={$mod}&file={$file}&action={$action}">配置选项</a></span></div>
        </div>
        <div class="result-wrap">
            <form action="" method="post" name="mysubmitform" id="mysubmitform" enctype="multipart/form-data">
            	<input type="hidden" value="1" name="dosubmit">
                <div class="config-items">
                    <ul class="toggle-ul">
						<li class="hover" style="border-left:#F3F3F3 1px solid" id="title_panel_1" onClick="panelToggle(1,1,'panel');"><a href="javascript:void(0);">配置选项</a></li>
					</ul>
					<div class="result-content" id="content_panel_1">
                        <table width="100%" class="insert-tab">
                            <tbody>
								<tr class="formtr">
                                    <th class="formth" width="20%"><i class="require-red">*</i>选项（如：SEO标题等）：</th>
                                    <td class="formtd">
                                 	<input type="text" class="common-text" name="config[wechat_dietitian_seo_title]" value="{$PW['wechat_dietitian_seo_title']}" size="36" />
                                    </td>

                                </tr>
                                <!--
                                您可以无限拓展配置的选项 不过值请以 wechat_dietitian_ 开头，以防止跟其他模块选项值冲突
                                您可以在前台用 $PW['wechat_dietitian_example'] 读取这个选项

                                <tr class="formtr">
                                    <th class="formth" width="20%"><i class="require-red">*</i>选项：</th>
                                    <td class="formtd">
                                    <input type="text" class="common-text" name="config[wechat_dietitian_example]" value="{$PW['wechat_dietitian_example']}" size="36" />
                                    </td>
                                    
                                </tr>
                                -->
                                <tr class="formtr">
                                    <th class="formth"></th>
                                    <td class="formtd">
                                        <input type="button" onClick="doSubmit('mysubmitform','')" value="提 交" class="submit-button">
                                        <input type="button" value="返 回" onClick="history.go(-1)" class="reset-button">
                                    </td>
                                </tr>
                            </tbody></table>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="statics-footer"> Powered by phpWeChat V{__PHPWECHAT_VERSION__}{__PHPWECHAT_RELEASE__} © , Processed in {php echo microtime()-$PW['time_start'];} second(s) , {MySql::$mQuery} queries <a href="#">至顶端↑</a></div>
</body>
</html>