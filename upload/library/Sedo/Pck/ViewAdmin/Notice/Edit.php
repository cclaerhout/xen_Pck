<?php

class Sedo_Pck_ViewAdmin_Notice_Edit extends XFCP_Sedo_Pck_ViewAdmin_Notice_Edit
{
	public function renderHtml()
	{

		if(class_exists('XenForo_ViewAdmin_Notice_Edit') && method_exists('XenForo_ViewAdmin_Notice_Edit', 'renderHtml'))
		{
			parent::renderHtml();
		}

		if(XenForo_Application::get('options')->get('sedo_pck_default_editor'))
		{
			$editorName = 'message';
			$html = $this->_params['notice']['message'];
		
			$this->_params['editorTemplate'] = XenForo_ViewPublic_Helper_Editor::getEditorTemplate(
				$this, $editorName, $html
			);

			/*The getEditorTemplate doesn't have an option to bypass the Wysiwyg formatter, let's trick it*/
			$raw_message = $this->_params['editorTemplate']->getParam('message');
			$this->_params['editorTemplate']->setParam('messageHtml', $raw_message);
			
			$raw_name = $this->_params['editorTemplate']->getParam('formCtrlName');			
			$this->_params['editorTemplate']->setParam('formCtrlNameHtml', $raw_name);
		}
	}
}