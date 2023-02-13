import apiFetch from '@wordpress/api-fetch';
import {
  useState,
  useEffect
} from '@wordpress/element';

import {
  SelectControl
} from "@wordpress/components";





export default function edit(props) {
  const {
    attributes: {
      selectedLocations
    },
    setAttributes
  } = props;

  const [locations, setLocations] = useState([]);
  const [relations, setRelations] = useState({});

  useEffect(() => {
    apiFetch({
      method: 'POST',
      path: '/ipm/v1/maps/get-filtered-locations'
    }).then((data) => {
      setLocations(data);
      configureRelations(selectedLocations[0], 0);
    }).catch((e) => {
      console.log('error', e);
    });
  }, []);


  const configureRelations = (location, index) => {
    if (undefined === location) {
      return setRelations({});
    }

    let tempRelation = {...relations};
    tempRelation[index] = [location.toString()];

    for (let i = index + 1; i < locations.length; i++) {
      const locs = locations[i];
      const parents = tempRelation[i - 1];
      tempRelation[i] = [];
      locs.forEach((current) => {
        if (parents.includes(current.parent.toString())) {
          tempRelation[i].push(current.id.toString());
        }
      });
    }

    setRelations(tempRelation);
  }

  let selectors = [];

  locations.forEach((list, i) => {
    let options  = [{
      "label": "All",
      "value": "-1"
    }];

    list.forEach((location) => {
      if (
        i === 0
        || relations[i - 1] && relations[i - 1].includes(location.parent.toString())
      ) {
        options.push({
          "label": location.name,
          "value": location.id.toString()
        });
      }
    });

    const Select = <SelectControl
      value={selectedLocations && selectedLocations[i] ? selectedLocations[i] : "-1"}
      options={options}
      onChange={(val) => {
        configureRelations(val, i);
        const tempLocations = [...selectedLocations];
        tempLocations[i] = val;
        setAttributes({selectedLocations: tempLocations});
      }}
    />

    selectors.push(Select);
  });



  return (
    <div className="point-map-filter">
      {selectors}
    </div>
  );
}