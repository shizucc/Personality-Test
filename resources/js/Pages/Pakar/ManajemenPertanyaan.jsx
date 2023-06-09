import SidebarPakar from "./SidebarPakar"
import TablePertanyaan from "./Partials/TablePertanyaan"
import AddRoundedIcon from '@mui/icons-material/AddRounded';
import { Head, Link } from '@inertiajs/react';

export default function ManajemenPertanyaan(props){

    return(<>
    <SidebarPakar username={props.auth.user.username}>
        <Head>
            <title>Manajemen Pertanyaan</title>
        </Head>
        <h1 className="mb-5 font-poppins font-medium text-4xl">Manajemen Pertanyaan</h1>
        <Link className="my-3 py-3 px-5 bg-[#98A8F8] text-white rounded-lg font-medium hover:bg-[#7286E8] duration-500 ease-in-out" href={route('pakar.pertanyaan.create')} ><AddRoundedIcon/><span className="font-poppins font-medium"> Tambah Pertanyaan</span></Link>
        <TablePertanyaan 
            datas={props.pertanyaans}
            route_for_show={''}
            route_for_edit={'pakar.pertanyaan.edit'}
            route_for_update={'pakar.pertanyaan.update'}
            route_for_delete={'pakar.pertanyaan.destroy'}
            message_where_delete={'Apakah anda yakin ?'}
        />
    </SidebarPakar>
    </>)
}