import React from "react";
import Table from "./Table";

function App(props) {
    let datas = []
    let i = 1
    props.datas.forEach(ciri => {
        datas.push({
            'id' : ciri.id,
            'ciriciri' : (ciri.ciri).charAt(0).toUpperCase() + ciri.ciri.slice(1),
            'kepribadian' : ciri.kepribadian.jenis_kepribadian
        })
        i+=1
    });

  const columns = React.useMemo(
    () => [
      {
        Header: "Ciri-Ciri",
        accessor: "ciriciri",
      },
      {
        Header: "Kepribadian Terkait",
        accessor: "kepribadian",
      },
    ],
    []
  );

  const data = datas
  return (
    <>
      <div>
        <Table 
          signature={'ciri_ciri'}
          columns={columns} 
          data={data} 
          route_for_edit={props.route_for_edit} 
          route_for_delete={props.route_for_delete}
          route_for_show = {props.route_for_show}
          message_where_delete={props.message_where_delete}
        />
      </div>
    </>
  );
}

export default App;