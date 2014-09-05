<?php
class Sedo_Pck_ViewPublic_Page_View extends XFCP_Sedo_Pck_ViewPublic_Page_View
{
	public function renderHtml()
	{
		parent::renderHtml();

		if(XenForo_Application::get('options')->get('sedo_pck_parse_bbcode'))
		{
			$formatterOptions = array(
				'view' => $this,
				'smilies' => array()
			);
			
			$bbCodeParser = XenForo_BbCode_Parser::create(XenForo_BbCode_Formatter_Base::create('Base', $formatterOptions));
			$content = $this->_params['templateHtml']->render();
			$content = $bbCodeParser->render($content);
			$this->_params['templateHtml'] = htmlspecialchars_decode($content);
		}
	}
}