import axios from 'axios';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Link } from 'react-router-dom';
import { Table, Button, Modal, ModalHeader, ModalBody, ModalFooter, Input, FormGroup, Label } from 'reactstrap';
import Header from './Header';
import Footer from './Footer';
import "bootstrap/dist/css/bootstrap.min.css";
import Pagination from 'react-js-pagination';


export default class Example extends Component {

    constructor () {
        super()
        this.state = {
            documents: null
        }
    }

    async componentWillMount(){
        await this.getDocumentsData();
    }

    async getDocumentsData(pageNumber = 1){

        const url = `http://10.234.15.25/arms/api/document_list?page=${pageNumber}`;

        const response = await axios.get(url);

        this.setState({ documents: response.data });
    }

    renderDocumentList(){

        const { data, current_page, per_page, total } = this.state.documents;

        return (

            <React.Fragment>

                    {data.map((document, index) => {
                        {/*return <li className="list-group-item" key={index}>{ document.item_name }</li>*/}

                        return <tr key={index}>
                                    <td style={{ textAlign: 'center' }}>{ document.id }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.item_name }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.service_type }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.brand }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.model }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.serial_no }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.unit }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.department }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.user }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.original_placement_location}</td>
                                    <td style={{ textAlign: 'center' }}>{ document.original_document_location }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.last_renewal_date }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.next_renewal_date }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.vendor }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.amount }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.remarks }</td>
                                    <td style={{ textAlign: 'center' }}></td>
                                </tr>
                    })
                    }


                <tr>
                    <td colSpan="17" className="justify-content-md-center">
                        <Pagination
                            activePage={current_page}
                            totalItemsCount={total}
                            itemsCountPerPage={per_page}
                            onChange={(pageNumber) => this.getDocumentsData(pageNumber)}
                            itemClass="page-item"
                            linkClass="page-link"
                            firstPageText="First"
                            lastPageText="Last"
                        />
                    </td>
                </tr>
            </React.Fragment>

        );
    }

    render () {

        const { documents } = this.state;

        return (

            <div className='container' style={{ height: '100%', position: 'absolute', left: '0px', width: '100%' }}>
                <div className='row'>
                    <div className='col-md-12'>

                        <Table striped bordered hover>
                            <thead>
                                <tr>
                                    <th colSpan="3" style={{ textAlign: 'left', fontSize: '22px' }}>DOCUMENTS</th>
                                    <th colSpan="14"></th>
                                </tr>
                                <tr style={{ backgroundColor: '#c9fa73' }}>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>#</th>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>Item</th>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>Service</th>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>Brand</th>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>Model</th>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>Series</th>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>Unit</th>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>Dept.</th>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>Liable Person</th>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>Orig. Loc.</th>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>Doc. Loc.</th>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>Last Renew</th>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>Next Renew</th>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>Vendor</th>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>Amount</th>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>Remarks</th>
                                    <th style={{ textAlign: 'center', fontSize: '18px' }}>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                { documents && this.renderDocumentList() }
                            </tbody>
                        </Table>

                    </div>
                </div>
            </div>
        )
    }
}

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
