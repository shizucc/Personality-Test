import * as React from 'react';
import Box from '@mui/material/Box';
import InputLabel from '@mui/material/InputLabel';
import MenuItem from '@mui/material/MenuItem';
import FormControl from '@mui/material/FormControl';
import Select from '@mui/material/Select';

export default function BasicSelect(props) {
  const [{children}, setSelect] = React.useState('');

  const handleChange = (event) => {
    setSelect(event.target.value);
  };

  return (
    <Box className="w-4/5 text-left m-auto h-[40px] mb-8">
      <FormControl fullWidth>
        <InputLabel id="demo-simple-select-label">{props.nama}</InputLabel>
        <Select
          labelId="demo-simple-select-label"
          id="demo-simple-select"
          value={children}
          label="NamaSelect"
          onChange={handleChange}
        >
          <MenuItem value={10}>User</MenuItem>
          <MenuItem value={20}>Pakar</MenuItem>
          <MenuItem value={30}>Admin</MenuItem>
        </Select>
      </FormControl>
    </Box>
  );
}