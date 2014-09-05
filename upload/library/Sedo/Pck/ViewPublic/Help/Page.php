<?php
class Sedo_Pck_ViewPublic_Help_Page extends XFCP_Sedo_Pck_ViewPublic_Help_Page
{
	public function renderHtml()
	{
		parent::renderHtml();

		if(XenForo_Application::get('options')->get('sedo_pck_parse_bbcode_help_page'))
		{
			$formatterOptions = array(
				'view' => $this,
				'smilies' => array()
			);
			
			$bbCodeParser = XenForo_BbCode_Parser::create(XenForo_BbCode_Formatter_Base::create('Base', $formatterOptions));
			$content = $this->_params['templateHtml']->render();
			$content = $bbCodeParser->render($content);
			$content = htmlspecialchars_decode($content);
			$content = str_replace("</p><br />\n<br />", "</p>", $content);	
			$this->_params['templateHtml'] = $content;
		}
	}
}