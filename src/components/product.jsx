import React, { Component } from 'react';
import styled from 'styled-components';
import { Draggable } from 'react-beautiful-dnd';

const Container = styled.div`
    border: 1px solid lightgrey;
    padding: 8px;
    margin-bottom: 8px;
    border-radius: 2px;
    background-color: #fff;
    float: left;
    box-sizing: border-box;
    text-align: center;
    font-size: 15px;
`;


export default class Product extends Component {
    render(){
        return (
            <Draggable draggableId={this.props.product.id} index={this.props.index}>
                {(provided) => (
                    <Container
                        {...provided.draggableProps}
                        {...provided.dragHandleProps}
                        ref={provided.innerRef}
                    >
                        <img src={this.props.product.content} alt="menu" style={{'width': '100px'}} /><br />
                        ${this.props.product.price}
                    </Container>
                )}
            </Draggable>
        );
    }
}