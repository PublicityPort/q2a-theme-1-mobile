<?php


	class cs_ask_widget {

		function cs_widget_form()
		{
			
			return array(
				'style' => 'wide',
				'fields' => array(
					'cs_ask_intro_message' => array(
						'label' => 'Your ask intro message',
						'type' => 'text',
						'tags' => 'name="cs_ask_intro_message"',
					),
					'cs_ask_placeholder_message' => array(
						'label' => 'Your ask placeholder message',
						'type' => 'text',
						'tags' => 'name="cs_ask_placeholder_message"',
						//'value' => '10',
					),
				),
			);
		}
		
		function allow_template($template)
		{
			$allow=false;
			
			switch ($template)
			{
				case 'activity':
				case 'qa':
				case 'questions':
				case 'hot':
				case 'ask':
				case 'categories':
				case 'question':
				case 'tag':
				case 'tags':
				case 'unanswered':
				case 'user':
				case 'users':
				case 'search':
				case 'admin':
				case 'custom':
					$allow=true;
					break;
			}
			
			return $allow;
		}

		
		function allow_region($region)
		{
			$allow=false;
			
			switch ($region)
			{
				case 'main':
				case 'side':
				case 'full':
					$allow=true;
					break;
			}
			
			return $allow;
		}
		

		function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
		{
			
			if (isset($qa_content['categoryids']))
				$params=array('cat' => end($qa_content['categoryids']));
			else
				$params=null;
			$widget_opt = @$themeobject->current_widget['param']['options'];
			$ask_intro_message = $widget_opt['cs_ask_intro_message'];
			$ask_placeholder_message = $widget_opt['cs_ask_placeholder_message'];
			
			$themeobject->output('<div class="ra-ask-widget">');
			$themeobject->output(
				'<h1 class="intro-title"> ' . (
					$ask_intro_message != null || $ask_intro_message != "" ?
					$ask_intro_message :
					qa_lang_html('cleanstrap/got_questions') ). '</h1>'.
				'<form action="'.qa_path_html('ask', $params).'" method="post">' ,
					'<div class="input-group">
						  <input type="text"  name="title" class="form-control" id="ra-ask-search" placeholder="' . (
							$ask_placeholder_message != null && $ask_placeholder_message != "" ?
							$ask_placeholder_message :  
							qa_lang_html('cleanstrap/askbox_placeholder') ). '">
						  <span class="input-group-btn">
							<button class="icon-question btn" type="submit">' . qa_lang_html('cleanstrap/askbox_ask') . '</button>
						  </span>
					</div>',
					'<input type="hidden" value="1" name="doask1">',
				'</form>'
			);
			$themeobject->output('</div>');
		}
	
	}
	
/*

'<h1 class="intro-title"> ' . (
                $ask_intro_message != null || $ask_intro_message != "" ?
                $ask_intro_message :
                qa_lang_html('cleanstrap/got_questions') ). '</h1>'

/*
	Omit PHP closing tag to help avoid accidental output
*/