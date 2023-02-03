import apiFetch from '@wordpress/api-fetch';
import {
  useState,
  useEffect
} from '@wordpress/element';


export default function edit(props) {
  const [locations, setLocations] = useState([]);
  useEffect(() => {
    apiFetch({
      method: 'POST',
      path: '/ipm/v1/maps/get-locations'
    }).then((data) => {
      console.log('data', data);
      setLocations(data);
    }).catch((e) => {
      console.log('error', e);
    });
  }, []);
  console.log('points map')
  return 'points-map';
}