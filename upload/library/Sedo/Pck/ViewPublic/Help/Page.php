<?php
class Sedo_Pck_ViewPublic_Help_Page extends XFCP_Sedo_Pck_ViewPublic_Help_Page
{
	public function renderHtml()
	{
		parent::renderHtml();
		$content = $this->_params['templateHtml']->render();
		$bbCodeMode = false;

		if(XenForo_Application::get('options')->get('sedo_pck_parse_bbcode_help_page'))
		{
			$bbCodeMode = true;
			$formatterOptions = array(
				'view' => $this,
				'smilies' => array()
			);
			
			$bbCodeParser = XenForo_BbCode_Parser::create(XenForo_BbCode_Formatter_Base::create('Base', $formatterOptions));

			$content = Sedo_Pck_Helper::BbCodeOutputBefore($content);
			$content = $bbCodeParser->render($content);
			$content = Sedo_Pck_Helper::BbCodeOutputAfter($content);

			$content = htmlspecialchars_decode($content);
		}

		$content = Sedo_Pck_Helper::finalOutput($content, $bbCodeMode);
		$this->_params['templateHtml'] = $content;
	}
}