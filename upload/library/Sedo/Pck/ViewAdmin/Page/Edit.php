<?php

class Sedo_Pck_ViewAdmin_Page_Edit extends XFCP_Sedo_Pck_ViewAdmin_Page_Edit
{
	public function renderHtml()
	{
		parent::renderHtml();
		
		if(XenForo_Application::get('options')->get('sedo_pck_parse_bbcode'))
		{
			$this->_params['editorTemplate'] = XenForo_ViewPublic_Helper_Editor::getEditorTemplate(
				$this, 'template', $this->_params['template']['template']
			);

			/*The getEditorTemplate doesn't have an option to bypass the Wysiwyg formatter, let's trick it*/
			$raw_message = $this->_params['editorTemplate']->getParam('message');
			$this->_params['editorTemplate']->setParam('messageHtml', $raw_message);
			
			$raw_name = $this->_params['editorTemplate']->getParam('formCtrlName');			
			$this->_params['editorTemplate']->setParam('formCtrlNameHtml', $raw_name);
		}
	}
}