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
		edit: (props) => {
			console.log('pr', props);
			return (
				<div className="map">
					<h1>Here we go</h1>
				</div>
			)
		},
		save: (props) => {
			console.log('pr s', props);
		}
	},
)
