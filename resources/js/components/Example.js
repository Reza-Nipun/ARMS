import axios from 'axios';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Link } from 'react-router-dom';
import { Table, Button, Modal, ModalHeader, ModalBody, ModalFooter, Input, FormGroup, Label } from 'reactstrap';
import Header from './Header';
import Footer from './Footer';

export default class Example extends Component {
    constructor () {
        super()
        this.state = {
            documents: []
        }
    }

    componentDidMount () {
        axios.get('/arms/api/document_list').then(response => {
            this.setState({
                documents: response.data
            })
        })
    }

    render () {

        let documents = this.state.documents.map((document) => {
            return(
                <tr key={document.id}>
                    <td scope="row" style={{ textAlign: 'center' }}>{document.id}</td>
                    <td style={{ textAlign: 'center' }}>{document.item_name}</td>
                    <td style={{ textAlign: 'center' }}>{document.service_type}</td>
                    <td style={{ textAlign: 'center' }}>{document.brand}</td>
                    <td style={{ textAlign: 'center' }}>{document.model}</td>
                    <td style={{ textAlign: 'center' }}>{document.serial_no}</td>
                    <td style={{ textAlign: 'center' }}>{document.unit}</td>
                    <td style={{ textAlign: 'center' }}>{document.department}</td>
                    <td style={{ textAlign: 'center' }}>{document.user}</td>
                    <td style={{ textAlign: 'center' }}>{document.original_placement_location}</td>
                    <td style={{ textAlign: 'center' }}>{document.original_document_location}</td>
                    <td style={{ textAlign: 'center' }}>{document.last_renewal_date}</td>
                    <td style={{ textAlign: 'center' }}>{document.next_renewal_date}</td>
                    <td style={{ textAlign: 'center' }}>{document.vendor}</td>
                    <td style={{ textAlign: 'center' }}>{document.amount}</td>
                    <td style={{ textAlign: 'center' }}>{document.remarks}</td>
                    <td style={{ textAlign: 'center' }}></td>
                </tr>
            )
        })

        return (

            <div className='container' style={{ height: '100%', position: 'absolute', left: '0px', width: '100%' }}>
                <div className='row'>
                    <div className='col-md-12'>

                                <Table striped>
                                    <thead>
                                    <tr>
                                        <th style={{ textAlign: 'left', fontSize: '22px' }}>DOCUMENTS</th>
                                        <th colSpan="16"></th>
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
                                        {documents}
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
