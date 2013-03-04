<?php

define('FPDF_FONTPATH', 'font/');
require_once('fpdi.php');

class fpdfx extends fpdi
{

   var $headerFunction = null;
   var $footerFunction = null;

   //////////////////////////////////////////////////////////////////////
   // Main constructor - changed the defaults
   //
   function fpdfx($orientation='P',$unit='mm',$format='Letter')
   {
      parent::FPDF($orientation, $unit, $format);
   }
   //////////////////////////////////////////////////////////////////////


   //////////////////////////////////////////////////////////////////////
   // Custom functions

   function PageWidth()
   {
      return $this->w - $this->rMargin - $this->lMargin;
   }

   //////////////////////////////////////////////////////////////////////
   // Bullets
   //

   /**
    * Multicell with bullets
    *
    * @param unknown_type $w
    * @param unknown_type $h
    * @param unknown_type $blt
    * @param unknown_type $txt
    * @param unknown_type $border
    * @param unknown_type $align
    * @param unknown_type $fill
    */
   function MultiCellBlt($w,$h,$blt,$txt,$border=0,$align='L',$fill=0)
   {
      //Get bullet width including margins
      $blt_width = $this->GetStringWidth($blt)+$this->cMargin*2;

      //Save x
      $bak_x = $this->x;

      //Output bullet
      $this->Cell($blt_width,$h,$blt,0,'',$fill);
      //Output text
      $this->MultiCell($w-$blt_width,$h,$txt,$border,$align,$fill);

      //Restore x
      $this->x = $bak_x;
   }

   //////////////////////////////////////////////////////////////////////
   // Use of color names
   //
   var $palette = array(
   'aliceblue'=> '#F0F8FF',
   'antiquewhite'=> '#FAEBD7',
   'aqua'=> '#00FFFF',
   'aquamarine'=> '#7FFFD4',
   'azure'=> '#F0FFFF',
   'beige'=> '#F5F5DC',
   'bisque'=> '#FFE4C4',
   'black'=> '#000000',
   'blanchedalmond'=> '#FFEBCD',
   'blue'=> '#0000FF',
   'blueviolet'=> '#8A2BE2',
   'brown'=> '#A52A2A',
   'burlywood'=> '#DEB887',
   'cadetblue'=> '#5F9EA0',
   'chartreuse'=> '#7FFF00',
   'chocolate'=> '#D2691E',
   'coral'=> '#FF7F50',
   'cornflowerblue'=> '#6495ED',
   'cornsilk'=> '#FFF8DC',
   'crimson'=> '#DC143C',
   'cyan'=> '#00FFFF',
   'darkblue'=> '#00008B',
   'darkcyan'=> '#008B8B',
   'darkgoldenrod'=> '#B8860B',
   'darkgray'=> '#A9A9A9',
   'darkgreen'=> '#006400',
   'darkkhaki'=> '#BDB76B',
   'darkmagenta'=> '#8B008B',
   'darkolivegreen'=> '#556B2F',
   'darkorange'=> '#FF8C00',
   'darkorchid'=> '#9932CC',
   'darkred'=> '#8B0000',
   'darksalmon'=> '#E9967A',
   'darkseagreen'=> '#8FBC8B',
   'darkslateblue'=> '#483D8B',
   'darkslategray'=> '#2F4F4F',
   'darkturquoise'=> '#00CED1',
   'darkviolet'=> '#9400D3',
   'deeppink'=> '#FF1493',
   'deepskyblue'=> '#00BFFF',
   'dimgray'=> '#696969',
   'dodgerblue'=> '#1E90FF',
   'firebrick'=> '#B22222',
   'floralwhite'=> '#FFFAF0',
   'forestgreen'=> '#228B22',
   'fuchsia'=> '#FF00FF',
   'gainsboro'=> '#DCDCDC',
   'ghostwhite'=> '#F8F8FF',
   'gold'=> '#FFD700',
   'goldenrod'=> '#DAA520',
   'gray'=> '#808080',
   'green'=> '#008000',
   'greenyellow'=> '#ADFF2F',
   'honeydew'=> '#F0FFF0',
   'hotpink'=> '#FF69B4',
   'indianred'=> '#CD5C5C',
   'indigo'=> '#4B0082',
   'ivory'=> '#FFFFF0',
   'khaki'=> '#F0E68C',
   'lavender'=> '#E6E6FA',
   'lavenderblush'=> '#FFF0F5',
   'lawngreen'=> '#7CFC00',
   'lemonchiffon'=> '#FFFACD',
   'lightblue'=> '#ADD8E6',
   'lightcoral'=> '#F08080',
   'lightcyan'=> '#E0FFFF',
   'lightgoldenrodyellow'=> '#FAFAD2',
   'lightgreen'=> '#90EE90',
   'lightgrey'=> '#D3D3D3',
   'lightpink'=> '#FFB6C1',
   'lightsalmon'=> '#FFA07A',
   'lightseagreen'=> '#20B2AA',
   'lightskyblue'=> '#87CEFA',
   'lightslategray'=> '#778899',
   'lightsteelblue'=> '#B0C4DE',
   'lightyellow'=> '#FFFFE0',
   'lime'=> '#00FF00',
   'limegreen'=> '#32CD32',
   'linen'=> '#FAF0E6',
   'magenta'=> '#FF00FF',
   'maroon'=> '#800000',
   'mediumaquamarine'=> '#66CDAA',
   'mediumblue'=> '#0000CD',
   'mediumorchid'=> '#BA55D3',
   'mediumpurple'=> '#9370DB',
   'mediumseagreen'=> '#3CB371',
   'mediumslateblue'=> '#7B68EE',
   'mediumspringgreen'=> '#00FA9A',
   'mediumturquoise'=> '#48D1CC',
   'mediumvioletred'=> '#C71585',
   'midnightblue'=> '#191970',
   'mintcream'=> '#F5FFFA',
   'mistyrose'=> '#FFE4E1',
   'moccasin'=> '#FFE4B5',
   'navajowhite'=> '#FFDEAD',
   'navy'=> '#000080',
   'oldlace'=> '#FDF5E6',
   'olive'=> '#808000',
   'olivedrab'=> '#6B8E23',
   'orange'=> '#FFA500',
   'orangered'=> '#FF4500',
   'orchid'=> '#DA70D6',
   'palegoldenrod'=> '#EEE8AA',
   'palegreen'=> '#98FB98',
   'paleturquoise'=> '#AFEEEE',
   'palevioletred'=> '#DB7093',
   'papayawhip'=> '#FFEFD5',
   'peachpuff'=> '#FFDAB9',
   'peru'=> '#CD853F',
   'pink'=> '#FFC0CB',
   'plum'=> '#DDA0DD',
   'powderblue'=> '#B0E0E6',
   'purple'=> '#800080',
   'red'=> '#FF0000',
   'rosybrown'=> '#BC8F8F',
   'royalblue'=> '#4169E1',
   'saddlebrown'=> '#8B4513',
   'salmon'=> '#FA8072',
   'sandybrown'=> '#F4A460',
   'seagreen'=> '#2E8B57',
   'seashell'=> '#FFF5EE',
   'sienna'=> '#A0522D',
   'silver'=> '#C0C0C0',
   'skyblue'=> '#87CEEB',
   'slateblue'=> '#6A5ACD',
   'slategray'=> '#708090',
   'snow'=> '#FFFAFA',
   'springgreen'=> '#00FF7F',
   'steelblue'=> '#4682B4',
   'tan'=> '#D2B48C',
   'teal'=> '#008080',
   'thistle'=> '#D8BFD8',
   'tomato'=> '#FF6347',
   'turquoise'=> '#40E0D0',
   'violet'=> '#EE82EE',
   'wheat'=> '#F5DEB3',
   'white'=> '#FFFFFF',
   'whitesmoke'=> '#F5F5F5',
   'yellow'=> '#FFFF00',
   'yellowgreen'=> '#9ACD32',
   );

   function Header()
   {
      if (!empty($this->headerFunction))
      {
         call_user_func($this->headerFunction);
      }
   }

   function SetHeader($function)
   {
      $this->headerFunction = $function;
   }

   function Footer()
   {
      if (!empty($this->footerFunction))
      {
         call_user_func($this->footerFunction);
      }
   }

   function SetFooter($function)
   {
      $this->footerFunction = $function;
   }

   function SetDrawColor($color, $green=-2, $blue=-2)
   {
      $color = $this->_getColor($color, $green, $blue);
      parent::SetDrawColor($color[0],$color[1],$color[2]);
   }

   function SetTextColor($color, $green=-2, $blue=-2)
   {
      $color = $this->_getColor($color, $green, $blue);
      parent::SetTextColor($color[0],$color[1],$color[2]);
   }

   function SetFillColor($color, $green=-2, $blue=-2)
   {
      $color = $this->_getColor($color, $green, $blue);
      parent::SetFillColor($color[0],$color[1],$color[2]);
   }

   function _colorArray($color)
   {
      if ($color[0] == '#')
      {
         $hex = $color;
      }
      else
      {
         $hex = $this->palette[$color];
      }
      if (empty($hex))
      {
         $color_array = array(0, 0, 0);
      }
      else
      {
         $red = hexdec($hex[1] . $hex[2]);
         $green = hexdec($hex[3] . $hex[4]);
         $blue = hexdec($hex[5] . $hex[6]);
         $color_array = array($red, $green, $blue);
      }

      return $color_array;
   }

   function _getColor($color, $green=-2, $blue=-2)
   {
      if (!is_array($color))
      {
         if ($green == -2)
         {
            $color = $this->_colorArray($color);
         }
         else
         {
            $color = array($color, $green, $blue);
         }
      }
      return $color;
   }
   //////////////////////////////////////////////////////////////////////

   //////////////////////////////////////////////////////////////////////
   // Style table extension
   //
   function DefineStyle($tag,$family,$style,$size,$color='black',$bgcolor='white')
   {
      $tag = trim($tag);
      $this->tagstyle[$tag]['family'] = trim($family);
      $this->tagstyle[$tag]['style'] = trim($style);
      $this->tagstyle[$tag]['size'] = trim($size);
      $this->tagstyle[$tag]['color'] = trim($color);
      $this->tagstyle[$tag]['bgcolor'] = trim($bgcolor);
   }

   function SetStyle($tag)
   {
      $tag=trim($tag);
      $this->SetFont($this->tagstyle[$tag]['family'],
      $this->tagstyle[$tag]['style'],
      $this->tagstyle[$tag]['size']);
      $this->SetTextColor($this->tagstyle[$tag]['color']);
      $this->SetFillColor($this->tagstyle[$tag]['bgcolor']);
   }
   //////////////////////////////////////////////////////////////////////

   //////////////////////////////////////////////////////////////////////
   // Table extension
   //
   var $widths;
   var $aligns;
   var $weights;
   var $height=0;

   function SetWidths($w)
   {
      //Set the array of column widths
      $this->widths=$w;
   }

   function SetHeight($h)
   {
      //Set the column height
      $this->height=$h;
   }

   function SetAligns($a)
   {
      //Set the array of column alignments
      $this->aligns=$a;
   }

   function SetFontWeights($w)
   {
      //Set the array of font weights
      $this->weights=$w;
   }

   function Row($data)
   {
      //Calculate the height of the row
      $nb=0;
      for ($i=0;$i<count($data);$i++)
      {
         $this->SetFont('', $this->weights[$i]);
         $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
      }
      $h=($this->FontSize+1)*$nb;
      $h = max($h,$this->height);
      //Issue a page break first if needed
      $this->CheckPageBreak($h);
      //Draw the cells of the row
      for ($i=0;$i<count($data);$i++)
      {
         $w=$this->widths[$i];
         $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
         //Save the current position
         $x=$this->GetX();
         $y=$this->GetY();
         //Draw the border
         $this->Rect($x,$y,$w,$h,'DF');

         //Print the text
         $this->SetFont('', $this->weights[$i]);
         $this->MultiCell($w,$this->FontSize+1,$data[$i],0,$a);
         //Put the position to the right of the cell
         $this->SetXY($x+$w,$y);
      }
      //Go to the next line
      $this->Ln($h);
   }

   function CheckPageBreak($h)
   {
      //If the height h would cause an overflow, add a new page immediately
      if ($this->GetY()+$h>$this->PageBreakTrigger)
      {
         $this->AddPage($this->CurOrientation);
      }
   }

   function NbLines($w,$txt)
   {
      //Computes the number of lines a MultiCell of width w will take
      $cw=$this->CurrentFont['cw'];
      if ($w==0)
      {
         $w=$this->w-$this->rMargin-$this->x;
      }
      $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
      $s=str_replace("\r",'',$txt);
      $nb=strlen($s);
      if ($nb>0 and $s[$nb-1]=="\n")
      {
         $nb--;
      }
      $sep=-1;
      $i=0;
      $j=0;
      $l=0;
      $nl=1;
      while($i<$nb)
      {
         $c=$s[$i];
         if ($c=="\n")
         {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
         }
         if ($c==' ')
         {
            $sep=$i;
         }
         $l+=$cw[$c];
         if ($l>$wmax)
         {
            if ($sep==-1)
            {
               if ($i==$j)
               {
                  $i++;
               }
            }
            else
            {
               $i=$sep+1;
            }
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
         }
         else
         {
            $i++;
         }
      }
      return $nl;
   }
   //////////////////////////////////////////////////////////////////////

   //////////////////////////////////////////////////////////////////////
   // Circle and Ellipse extension
   //
   function Circle($x,$y,$r,$style='')
   {
      $this->Ellipse($x,$y,$r,$r,$style);
   }

   function Ellipse($x,$y,$rx,$ry,$style='D')
   {
      if ($style=='F')
      {
         $op='f';
      }
      else if ($style=='FD' or $style=='DF')
      {
         $op='B';
      }
      else
      {
         $op='S';
      }
      $lx=4/3*(M_SQRT2-1)*$rx;
      $ly=4/3*(M_SQRT2-1)*$ry;
      $k=$this->k;
      $h=$this->h;
      $this->_out(sprintf('%.2f %.2f m %.2f %.2f %.2f %.2f %.2f %.2f c',
      ($x+$rx)*$k,($h-$y)*$k,
      ($x+$rx)*$k,($h-($y-$ly))*$k,
      ($x+$lx)*$k,($h-($y-$ry))*$k,
      $x*$k,($h-($y-$ry))*$k));
      $this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c',
      ($x-$lx)*$k,($h-($y-$ry))*$k,
      ($x-$rx)*$k,($h-($y-$ly))*$k,
      ($x-$rx)*$k,($h-$y)*$k));
      $this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c',
      ($x-$rx)*$k,($h-($y+$ly))*$k,
      ($x-$lx)*$k,($h-($y+$ry))*$k,
      $x*$k,($h-($y+$ry))*$k));
      $this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c %s',
      ($x+$lx)*$k,($h-($y+$ry))*$k,
      ($x+$rx)*$k,($h-($y+$ly))*$k,
      ($x+$rx)*$k,($h-$y)*$k,
      $op));
   }
   //////////////////////////////////////////////////////////////////////

   //////////////////////////////////////////////////////////////////////
   // Flowing block extension
   //

	var $flowingBlockAttr;

	function saveFont()
	{

		$saved = array();

		$saved[ 'family' ] = $this->FontFamily;
		$saved[ 'style' ] = $this->FontStyle;
		$saved[ 'sizePt' ] = $this->FontSizePt;
		$saved[ 'size' ] = $this->FontSize;
		$saved[ 'curr' ] = $this->CurrentFont;

		return $saved;

	}

	function restoreFont( $saved )
	{

		$this->FontFamily = $saved[ 'family' ];
		$this->FontStyle = $saved[ 'style' ];
		$this->FontSizePt = $saved[ 'sizePt' ];
		$this->FontSize = $saved[ 'size' ];
		$this->CurrentFont = $saved[ 'curr' ];

		if( $this->page > 0)
			$this->_out( sprintf( 'BT /F%d %.2f Tf ET', $this->CurrentFont[ 'i' ], $this->FontSizePt ) );

	}

	function newFlowingBlock( $w, $h, $b = 0, $a = 'J', $f = 0 )
	{

		// cell width in points
		$this->flowingBlockAttr[ 'width' ] = $w * $this->k;

		// line height in user units
		$this->flowingBlockAttr[ 'height' ] = $h;

		$this->flowingBlockAttr[ 'lineCount' ] = 0;

		$this->flowingBlockAttr[ 'border' ] = $b;
		$this->flowingBlockAttr[ 'align' ] = $a;
		$this->flowingBlockAttr[ 'fill' ] = $f;

		$this->flowingBlockAttr[ 'font' ] = array();
		$this->flowingBlockAttr[ 'content' ] = array();
		$this->flowingBlockAttr[ 'contentWidth' ] = 0;

	}

	function finishFlowingBlock()
	{

		$maxWidth = $this->flowingBlockAttr[ 'width' ];

		$lineHeight = $this->flowingBlockAttr[ 'height' ];

		$border = $this->flowingBlockAttr[ 'border' ];
		$align = $this->flowingBlockAttr[ 'align' ];
		$fill = $this->flowingBlockAttr[ 'fill' ];

		$content = $this->flowingBlockAttr[ 'content' ];
		$font = $this->flowingBlockAttr[ 'font' ];

		// set normal spacing
		$this->_out( sprintf( '%.3f Tw', 0 ) );

		// print out each chunk

		// the amount of space taken up so far in user units
		$usedWidth = 0;

		foreach ( $content as $k => $chunk )
		{

			$b = '';

			if ( is_int( strpos( $border, 'B' ) ) )
				$b .= 'B';

			if ( $k == 0 && is_int( strpos( $border, 'L' ) ) )
				$b .= 'L';

			if ( $k == count( $content ) - 1 && is_int( strpos( $border, 'R' ) ) )
				$b .= 'R';

			$this->restoreFont( $font[ $k ] );

			// if it's the last chunk of this line, move to the next line after
			if ( $k == count( $content ) - 1 )
				$this->Cell( ( $maxWidth / $this->k ) - $usedWidth + 2 * $this->cMargin, $lineHeight, $chunk, $b, 1, $align, $fill );
			else
				$this->Cell( $this->GetStringWidth( $chunk ), $lineHeight, $chunk, $b, 0, $align, $fill );

			$usedWidth += $this->GetStringWidth( $chunk );

		}

	}

	function WriteFlowingBlock( $s )
	{

		// width of all the content so far in points
		$contentWidth = $this->flowingBlockAttr[ 'contentWidth' ];

		// cell width in points
		$maxWidth = $this->flowingBlockAttr[ 'width' ];

		$lineCount = $this->flowingBlockAttr[ 'lineCount' ];

		// line height in user units
		$lineHeight = $this->flowingBlockAttr[ 'height' ];

		$border = $this->flowingBlockAttr[ 'border' ];
		$align = $this->flowingBlockAttr[ 'align' ];
		$fill = $this->flowingBlockAttr[ 'fill' ];

		$content = $this->flowingBlockAttr[ 'content' ];
		$font = $this->flowingBlockAttr[ 'font' ];

		$font[] = $this->saveFont();
		$content[] = '';

		$currContent = $content[ count( $content ) - 1 ];

		// where the line should be cutoff if it is to be justified
		$cutoffWidth = $contentWidth;

		// for every character in the string
		for ( $i = 0; $i < strlen( $s ); $i++ )
		{

			// extract the current character
			$c = $s{ $i };

			// get the width of the character in points
			$cw = $this->CurrentFont[ 'cw' ][ $c ] * ( $this->FontSizePt / 1000 );

			if ( $c == ' ' )
			{

				$currContent .= ' ';
				$cutoffWidth = $contentWidth;

				$contentWidth += $cw;

				continue;

			}

			// try adding another char
			if ( $contentWidth + $cw > $maxWidth )
			{

				// won't fit, output what we have
				$lineCount++;

				// contains any content that didn't make it into this print
				$savedContent = '';
				$savedFont = array();

				// first, cut off and save any partial words at the end of the string
				$words = explode( ' ', $currContent );

				// if it looks like we didn't finish any words for this chunk
				if ( count( $words ) == 1 )
				{

					// save and crop off the content currently on the stack
					$savedContent = array_pop( $content );
					$savedFont = array_pop( $font );

					// trim any trailing spaces off the last bit of content
					$currContent = $content[ count( $content ) - 1 ];

					$currContent = rtrim( $currContent );

				}

				// otherwise, we need to find which bit to cut off
				else
				{

					$lastContent = '';

					for ( $w = 0; $w < count( $words ) - 1; $w++)
						$lastContent .= "{$words[ $w ]} ";

					$savedContent = $words[ count( $words ) - 1 ];
					$savedFont = $this->saveFont();

					// replace the current content with the cropped version
					$currContent = rtrim( $lastContent );

				}

				// update $contentWidth and $cutoffWidth since they changed with cropping
				$contentWidth = 0;

				foreach ( $content as $k => $chunk )
				{

					$this->restoreFont( $font[ $k ] );

					$contentWidth += $this->GetStringWidth( $chunk ) * $this->k;

				}

				$cutoffWidth = $contentWidth;

				// if it's justified, we need to find the char spacing
				if( $align == 'J' )
				{

					// count how many spaces there are in the entire content string
					$numSpaces = 0;

					foreach ( $content as $chunk )
						$numSpaces += substr_count( $chunk, ' ' );

					// if there's more than one space, find word spacing in points
					if ( $numSpaces > 0 )
						$this->ws = ( $maxWidth - $cutoffWidth ) / $numSpaces;
					else
						$this->ws = 0;

					$this->_out( sprintf( '%.3f Tw', $this->ws ) );

				}

				// otherwise, we want normal spacing
				else
					$this->_out( sprintf( '%.3f Tw', 0 ) );

				// print out each chunk
				$usedWidth = 0;

				foreach ( $content as $k => $chunk )
				{

					$this->restoreFont( $font[ $k ] );

					$stringWidth = $this->GetStringWidth( $chunk ) + ( $this->ws * substr_count( $chunk, ' ' ) / $this->k );

					// determine which borders should be used
					$b = '';

					if ( $lineCount == 1 && is_int( strpos( $border, 'T' ) ) )
						$b .= 'T';

					if ( $k == 0 && is_int( strpos( $border, 'L' ) ) )
						$b .= 'L';

					if ( $k == count( $content ) - 1 && is_int( strpos( $border, 'R' ) ) )
						$b .= 'R';

					// if it's the last chunk of this line, move to the next line after
					if ( $k == count( $content ) - 1 )
						$this->Cell( ( $maxWidth / $this->k ) - $usedWidth + 2 * $this->cMargin, $lineHeight, $chunk, $b, 1, $align, $fill );
					else
					{

						$this->Cell( $stringWidth + 2 * $this->cMargin, $lineHeight, $chunk, $b, 0, $align, $fill );
						$this->x -= 2 * $this->cMargin;

					}

					$usedWidth += $stringWidth;

				}

				// move on to the next line, reset variables, tack on saved content and current char
				$this->restoreFont( $savedFont );

				$font = array( $savedFont );
				$content = array( $savedContent . $s{ $i } );

				$currContent = $content[ 0 ];

				$contentWidth = $this->GetStringWidth( $currContent ) * $this->k;
				$cutoffWidth = $contentWidth;

			}

			// another character will fit, so add it on
			else
			{

				$contentWidth += $cw;
				$currContent .= $s{ $i };

			}

		}

	}
   //////////////////////////////////////////////////////////////////////

   //////////////////////////////////////////////////////////////////////
   // Bookmark extension
   //

   var $outlines=array();
   var $OutlineRoot;

   function Bookmark($txt,$level=0,$y=0)
   {
      if ($y==-1)
      {
         $y=$this->GetY();
      }
      $this->outlines[]=array('t'=>$txt,'l'=>$level,'y'=>$y,'p'=>$this->PageNo());
   }

   function _putbookmarks()
   {
      $nb=count($this->outlines);
      if ($nb==0)
      {
         return;
      }
      $lru=array();
      $level=0;
      foreach($this->outlines as $i=>$o)
      {
         if ($o['l']>0)
         {
            $parent=$lru[$o['l']-1];
            //Set parent and last pointers
            $this->outlines[$i]['parent']=$parent;
            $this->outlines[$parent]['last']=$i;
            if ($o['l']>$level)
            {
               //Level increasing: set first pointer
               $this->outlines[$parent]['first']=$i;
            }
         }
         else
         {
            $this->outlines[$i]['parent']=$nb;
         }
         if ($o['l']<=$level and $i>0)
         {
            //Set prev and next pointers
            $prev=$lru[$o['l']];
            $this->outlines[$prev]['next']=$i;
            $this->outlines[$i]['prev']=$prev;
         }
         $lru[$o['l']]=$i;
         $level=$o['l'];
      }
      //Outline items
      $n=$this->n+1;
      foreach($this->outlines as $i=>$o)
      {
         $this->_newobj();
         $this->_out('<</Title '.$this->_textstring($o['t']));
         $this->_out('/Parent '.($n+$o['parent']).' 0 R');
         if (isset($o['prev']))
         {
            $this->_out('/Prev '.($n+$o['prev']).' 0 R');
         }
         if (isset($o['next']))
         {
            $this->_out('/Next '.($n+$o['next']).' 0 R');
         }
         if (isset($o['first']))
         {
            $this->_out('/First '.($n+$o['first']).' 0 R');
         }
         if (isset($o['last']))
         {
            $this->_out('/Last '.($n+$o['last']).' 0 R');
         }
         $this->_out(sprintf('/Dest [%d 0 R /XYZ 0 %.2f null]',1+2*$o['p'],($this->h-$o['y'])*$this->k));
         $this->_out('/Count 0>>');
         $this->_out('endobj');
      }
      //Outline root
      $this->_newobj();
      $this->OutlineRoot=$this->n;
      $this->_out('<</Type /Outlines /First '.$n.' 0 R');
      $this->_out('/Last '.($n+$lru[0]).' 0 R>>');
      $this->_out('endobj');
   }

   function _putresources()
   {
      parent::_putresources();
      $this->_putbookmarks();
   }

   function _putcatalog()
   {
      parent::_putcatalog();
      if (count($this->outlines)>0)
      {
         $this->_out('/Outlines '.$this->OutlineRoot.' 0 R');
         $this->_out('/PageMode /UseOutlines');
      }
   }

}