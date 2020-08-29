/*------------------------------------------------------------*/
$(function() {
	bidderUIPaintRows(document);
	/*	$(".imgToolTip").imgToolTip();	*/
	$(".showImage").showImage();
});
/*------------------------------------------------------------*/
function bidderUIPaintRows(context)
{
	$(".mRow", context).hoverClass("hilite");
	$(".bidderUIRow", context).hoverClass("hilite");
	$(".mFormRow", context).hoverClass("hilite");
	$(".mHeaderRow", context).addClass("bidderUIZebra0");
	$(".bidderUIHeaderRow", context).addClass("bidderUIZebra0");
	$(".mFormRow:nth-child(odd)", context).addClass("bidderUIZebra1");
	$(".mFormRow:nth-child(even)", context).addClass("bidderUIZebra2");
	$(".mRow:nth-child(odd)", context).addClass("bidderUIZebra1");
	$(".mRow:nth-child(even)", context).addClass("bidderUIZebra2");
	$(".bidderUIRow:nth-child(odd)", context).addClass("bidderUIZebra2");
	$(".bidderUIRow:nth-child(even)", context).addClass("bidderUIZebra1"); // first row is 1
	$(".bidderUIFormRow:nth-child(odd)", context).addClass("bidderUIZebra2");
	$(".bidderUIFormRow:nth-child(even)", context).addClass("bidderUIZebra1"); // first row is 1

	$(".today:nth-child(odd)", context).addClass("bidderUIZebra3");
	$(".today:nth-child(even)", context).addClass("bidderUIZebra4");
	$(".yesterday:nth-child(odd)", context).addClass("bidderUIZebra5");
	$(".yesterday:nth-child(even)", context).addClass("bidderUIZebra6");

}
/*------------------------------------------------------------*/
