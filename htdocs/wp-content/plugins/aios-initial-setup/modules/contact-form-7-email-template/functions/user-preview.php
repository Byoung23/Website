<?php 
	$user_preview_html = '
		<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="padding-top: 25px; padding-bottom: 25px;">
			<tr>
				<td align="center" valign="top">
					<table width="600" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="center" valign="top" bgcolor="#ffffff" style="padding-bottom: 20px; border-bottom: solid 1px #cacaca;' . $user_font_style . '">
								' . $header_user . '
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" bgcolor="#ffffff" style="padding: 20px 0 10px;' . $user_font_style . '">
								' . $intro_user . '
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" bgcolor="#ffffff" style="padding: 0;' . $user_font_style . '">
								<strong><em>Message Body</em></strong>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" bgcolor="#ffffff" style="padding: 10px 0 20px;' . $user_font_style . '">
								' . $closing_user . '
							</td>
						</tr>
						<tr>
							<td align="center" valign="top" bgcolor="#ffffff" style="padding-top: 20px; border-top: solid 1px #cacaca;' . $user_font_style . '">
								' . $footer_user . '
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>';
	echo do_shortcode($user_preview_html);
?>