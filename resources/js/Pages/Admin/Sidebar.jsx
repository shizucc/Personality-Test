import * as React from 'react';
import { styled } from '@mui/system';
import Tabs from '@mui/base/Tabs';
import TabsList from '@mui/base/TabsList';
import TabPanel from '@mui/base/TabPanel';
import { buttonClasses } from '@mui/base/Button';
import Tab, { tabClasses } from '@mui/base/Tab';
import IconDashboard from '@/Components/IconDashboard';
import IconManajemenPakar from '@/Components/IconManajemenPakar';
import IconManajemenUser from '@/Components/IconManajemenUser';
import IconHistoriDiagnosa from '@/Components/IconHistoriDiagnosa';
import IconLogout from '@/Components/IconLogout';
import MenuList from '@/Components/MenuList';
import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';



export default function SidebarAdmin(props) {
  const tab_active = (() => {
    switch(route().current()) {
      case 'admin.index':
        return 0;
      case 'admin.pakar.index':
        return 1;
      case 'admin.user.index':
        return 2;
      case 'admin.histori.index':
        return 3;
    }
  })();
  return (
      <div className='container'>
    <Tabs value={tab_active}>
        <div className='grid grid-cols-4'>
            <div>
            <StyledTabsList className='h-screen w-100'>
            <div className='grid-rows-3'>
              <div className='top-0 mb-10'><ApplicationLogo /></div>
              <div>
                <h1 className='text-center font-bold text-black text-xl mb-10'>{props.username}</h1>
              <StyledTab><Link href={route('admin.index')}><MenuList icon={<IconDashboard/>} nama="Dashboard"/></Link></StyledTab>
              <StyledTab><Link  href={route('admin.pakar.index')}><MenuList icon={<IconManajemenPakar/>} nama="Manajemen Pakar"/></Link></StyledTab>
              <StyledTab><Link href={route('admin.user.index')}><MenuList icon={<IconManajemenUser/>} nama="Manajemen Akun"/></Link></StyledTab>
              <StyledTab><Link href={route('admin.histori.index')}><MenuList icon={<IconHistoriDiagnosa/>} nama="Histori Diagnosa"/></Link></StyledTab>
              <hr className="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700"></hr>
              <StyledTab><Link href={route('logout')} method="post" as="button"><MenuList icon={<IconLogout/>} nama="Logout"/></Link></StyledTab>
              </div>
              <div><h1 className='bottom-0 end-0 inset-y-0 text-center text-black text-sm mt-20'>Copyright © Endour Studio</h1></div>
            </div>
          </StyledTabsList>
            </div>
        <div className='h-screen col-span-3 pl-10 pt-10 overflow'>
          {props.children}
        </div>

        </div>
    </Tabs>
    </div>



  );
}

const blue = {
  50: '#F0F7FF',
  100: '#C2E0FF',
  200: '#80BFFF',
  300: '#66B2FF',
  400: '#3399FF',
  500: '#007FFF',
  600: '#0072E5',
  700: '#0059B2',
  800: '#004C99',
  900: '#003A75',
};

const grey = {
  50: '#f6f8fa',
  100: '#eaeef2',
  200: '#d0d7de',
  300: '#afb8c1',
  400: '#8c959f',
  500: '#6e7781',
  600: '#57606a',
  700: '#424a53',
  800: '#32383f',
  900: '#24292f',
};

const StyledTab = styled(Tab)`
  font-family: IBM Plex Sans, sans-serif;
  color: ${grey[900]};
  cursor: pointer;
  font-size: 0.875rem;
  font-weight: 600;
  background-color: transparent;
  width: 200px;
  padding: 10px 12px;
  margin: 6px 6px;
  border: none;
  border-radius: 7px;
  display: inline;
  text-align: left;

  &:hover {
    background-color: #BCCEF8;
  }

  &:focus {
    color: #BCCEF8;
  }

  &.${tabClasses.selected} {
    background-color: #BCCEF8;
    color: ${grey[900]};
  }

  &.${buttonClasses.disabled} {
    opacity: 0.5;
    cursor: not-allowed;
  }
`;

const StyledTabPanel = styled(TabPanel)(
  ({ theme }) => `
  width: 100%;
  font-family: IBM Plex Sans, sans-serif;
  font-size: 0.875rem;
  padding: 20px 20px;
  border-radius: 12px;
  justify-content:center;
  `,
);

const StyledTabsList = styled(TabsList)(
  ({ theme }) => `
  width: 24%;
  background-color: '#FEF8F8';
  border-radius: 0px;
  border-right: 2px dashed #A9A9A9;
  margin-bottom: 0px;
  display: flex;
  padding:50px;
  position:fixed;
  align-items: center;
  align-content: space-between;
  `,
);
