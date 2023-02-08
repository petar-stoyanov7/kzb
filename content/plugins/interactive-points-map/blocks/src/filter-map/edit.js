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
      path: '/ipm/v1/maps/get-filtered-locations'
    }).then((data) => {
      console.log('kur', data);
      setLocations(data);
    }).catch((e) => {
      console.log('error', e);
    });
  }, []);



  return 'points-map';
}