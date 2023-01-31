import { registerBlockType } from "@wordpress/blocks";

import metadata from './block.json';
import edit from './edit';
import save from './save'

const {
	name,
	attributes,
	title,
	icon,
	supports
} = metadata;
console.log('meme', metadata);

registerBlockType(
	name,
	{
		title,
		icon,
		attributes,
		supports,
		edit: edit,
		save: save,
	},
)
