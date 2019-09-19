import React from 'react';
import './index.css';
import Header from '../Header';
import List from '../List';
import Note from '../Note';
import {generateId} from '../../utils';  // 랜덤 ID 생성 함수

class App extends React.Component {
    //state 선언하기
    state = {
        notes: [
            {
                id: 'initial',
                title: '심플노트에 오신것을 환영합니다!',
                contents: '차근차근 만들면서 리액트를 익혀보세요! 👻\n\n헤더의 추가 버튼을 클릭하여 새로운 노트를 만드실 수 있습니다.'
            }
        ],
        activeId: 'initial'
    };

    // 이벤트 핸들러 메소드
    handleListItemClick = (id) => {
        this.setState({activeId: id});
    };

    //편집 이벤트 핸들러
    handleEditNote = (type, e) => {
        //새 notes 어레이 생성
        const notes = [...this.state.notes];

        //notes에서 현재 acriveId와 일치하는 노트 객체 찾기
        const note = notes.find((item) => item.id === this.state.activeId);

        // 객체의 속성에 값 할당. note.title 또는 note.contents
        note[type] = e.target.value;

        //notes에 새 array를 할당하여 state 변경
        this.setState({
            notes
        });

    };

    // 추가 이벤트
    handleAddNote = () => {
        const id = generateId(); // 랜덤 ID 생성
        this.setState({
            notes: [
            ...this.state.notes,
                {
                    id,
                    title: '제목',
                    contents: '내용'
                }
            ],
            activeId: id
        });
    };

    // 삭제 이벤트
    handleDeleteNote = () => {
        // 현재 선택한 노트를 제외한 새로운 array를 생성
        const notes =
            this.state.notes.filter((item) => item.id !== this.state.activeId);

        this.setState({
            notes,
            activeId: notes.length === 0 ? null : notes[0].id
        });
    };

    render() {

        const {notes, activeId} = this.state;
        const activeNote = notes.filter((item) => item.id === activeId)[0];

        return(
            <div className="app">
                <Header
                    onAddNote={this.handleAddNote}
                    onDeleteNote={this.handleDeleteNote}
                />
                <div className="container">
                    <List
                        notes={notes}
                        activeId={activeId}
                        onListItemClick={this.handleListItemClick}  //메소드 전달
                    />
                    {
                        notes.length !== 0 &&
                        <Note
                            note={activeNote}
                            onEditNote={this.handleEditNote}  //메소드 전달
                        />
                    }
                </div>
            </div>
        )
    }
}

export default App;