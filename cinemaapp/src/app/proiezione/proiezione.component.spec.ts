import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ProiezioneComponent } from './proiezione.component';

describe('ProiezioneComponent', () => {
  let component: ProiezioneComponent;
  let fixture: ComponentFixture<ProiezioneComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ProiezioneComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ProiezioneComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
