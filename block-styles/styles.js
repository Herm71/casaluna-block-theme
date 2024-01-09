/**
 *  Block styles and variations and variations
 */
wp.domReady(() => {
	// Styles for core/details
	wp.blocks.registerBlockStyle("core/details", {
		name: "chevron",
		label: "Chevron",
	});
	wp.blocks.registerBlockStyle("core/details", {
		name: "plus",
		label: "Plus/Minus",
	});
	wp.blocks.registerBlockStyle("core/details", {
		name: "check",
		label: "Check mark",
	});
});
