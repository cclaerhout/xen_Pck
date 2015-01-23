<?php
class Sedo_Pck_ViewPublic_Account_Upgrades extends XFCP_Sedo_Pck_ViewPublic_Account_Upgrades
{
	public function parseDescription(array &$data)
	{
		if(!is_array($data))
		{
			return $data;
		}
		
		foreach($data as &$upgrade)
		{
			if(!empty($upgrade['description']))
			{
				$content = $upgrade['description'];
				$bbCodeMode = false;
		
				if(XenForo_Application::get('options')->get('sedo_pck_parse_bbcode_account_upgrades'))
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
		
				$upgrade['description'] = Sedo_Pck_Helper::finalOutput($content, $bbCodeMode);
			}
		}
	}

	public function renderHtml()
	{
		if(is_callable('parent::renderHtml'))
		{
			parent::renderHtml();
		}

		if(!empty($this->_params['available']))
		{
			$this->parseDescription($this->_params['available']);
		}
		
		if(!empty($this->_params['purchased']))
		{
			$this->parseDescription($this->_params['purchased']);		
		}
	}
}