import { registerBlockType } from "@wordpress/blocks";

import metadata from './block.json';

const {
	name,
	attributes,
	title,
	icon,
	supports
} = metadata;

registerBlockType(
	name,
	{
		title,
		icon,
		attributes,
		supports,
		edit: () => {
			return 'This is a example block'
		},
		save: () => {
			return 'This is an example block'
		},
	},
)
